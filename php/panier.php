<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AfNE3JJ7EtwG46wj6LKUtZN_5ZJxLktEDgUoy_aNZzYP_p_ntfLrgWi5NcNI7ADu1BvVKahVVfJ3MFpF"></script>
    <script src="../js/autocompletion.js" defer></script>
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <main>
        <h1>Mon Panier</h1>
        <div id="panier">
            <?php
            $isPanierExist = null;
            $somme = 0;
            $livraison = 4.99;
            $prixTotal = 0;
            $countArt = 0;
            $request = $bdd->prepare('SELECT * FROM `panier` WHERE `id_user` = ?');
            $request->execute([$_SESSION['user']['id']]);
            $result = $request->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                $isPanierExist = true;
                // Afficher les produits du panier
                foreach ($result as $produit) {
                    $articleIDPanier = $produit['id_article'];

                    // Récupérer les informations de l'article depuis la base de données
                    $request2 = $bdd->prepare('SELECT * FROM `articles` WHERE `idArt` = ?');
                    $request2->execute([$articleIDPanier]);
                    $result2 = $request2->fetch(PDO::FETCH_ASSOC);
                    $somme += $result2['prix'];
                    echo "<a href='detail.php?article_id=" . $result2['idArt'] ."'><img src='" . $result2['imgArt'] . " '></a><span>" . $result2['titreArt'] . " - Prix : " . $result2['prix'] . "€</span></br>";
                }
                // $somme c'est le prix AVEC TVA comprise
                $tva = (20/100); // on met la TVA toujours a 20% ici
                $prixTva = $somme / (1 + $tva);
                $prixTotal = $somme + $livraison;
                echo "<span>Sous total (hors taxes) : " . $prixTva . " €</span></br>
                <span>TVA : + 20% </span></br>
                <span>Frais de livraison : 4,99 € </span></br>
                <span>Total : " . ($prixTotal) . " €</span>";
            } else {
                $isPanierExist = false;
                echo "<p>Panier vide</p>";
                $somme = 0;
            }

            ?>
        </div>
        <div><span>Adresse de livraison :</span>
            <?php $adresse = new Adresse($_SESSION['user']['id'], '','','', '', '', '');
            if ($adresse->itExist($bdd)){
                $adresseCommande = $adresse->isExisting($bdd);
                echo $adresseCommande;
            }
            else {
                echo $adresse->isExisting($bdd);
            } 
            ?>
        </div>

        <div><span>Numero de téléphone :</span>
        <?php $user = new User($_SESSION['user']['id'],'','', '', '', '',''); 
        if ($user->isPhoneExist($bdd)){
            $phoneCommande = $user->selectPhoneNumber($bdd);
            echo $phoneCommande;
        }
        else { ?>
        <form method="POST">
            <input type="tel" id="phone" name="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="01 23 45 67 89" required>
            <input type="submit" name ="submitPhone" value="Ajouter">
            <?php if (isset($_POST['submitPhone'])){
                $user->addPhone($bdd);
                echo "enregistré";
                header('Location:panier.php');
            }
            ?>
        </form>
        <?php }
        
        if ($isPanierExist){
        ?>
        <div><span>Choisissez un moyen de payement :</span></div>
        <div id="paypal-boutons"></div>
         <script>
            paypal.Buttons({

            // Configurer la transaction
            createOrder : function (data, actions) {

            // Les produits à payer avec leurs details
            var produits = [
                {
                    name : "Produit 1",
                    description : "Description du produit 1",
                    quantity : 1,
                    unit_amount : { value : 9.9, currency_code : "USD" }
                },
                {
                    name : "Produit 2",
                    description : "Description du produit 2",
                    quantity : 1,
                    unit_amount : { value : 8.0, currency_code : "USD" }
                }
            ];

            // Le total des produits
            var total_amount = produits.reduce(function (total, product) {
                return total + product.unit_amount.value * product.quantity;
            }, 0);

            // La transaction
            return actions.order.create({
                purchase_units : [{
                    items : produits,
                    amount : {
                        value : total_amount,
                        currency_code : "USD",
                        breakdown : {
                            item_total : { value : total_amount, currency_code : "USD" }
                        }
                    }
                }]
            });
            }

            }).render("#paypal-boutons");
        </script>
        <form method="POST"><input type="submit" name="validerPanier" value="Valider la commande"></form>
        <?php 
        if (isset($_POST['validerPanier'])){ 
            $dateActuelle = date('Y-m-d');
            $request3 = $bdd->prepare('INSERT INTO `commande`(`adresse`, `id_user`, `phone`, `date`, `prixTotal`) VALUES (?,?,?,?,?)');
            $request3->execute([$adresseCommande, $_SESSION['user']['id'], $phoneCommande, $dateActuelle, $prixTotal]);
            $idcommande = $bdd->lastInsertId();

            if ($result) {
                // parcourir les produits du panier
                foreach ($result as $produit) {
                    $articleIDPanier = $produit['id_article'];
                    $request5 = $bdd->prepare('INSERT INTO `commandpanier`(`id_commande`, `id_article`) VALUES (?,?)');
                    $request5->execute([$idcommande, $articleIDPanier]);
                }
            }
            $request6 = $bdd->prepare('DELETE FROM `panier` WHERE `id_user` = (?)');
            $request6->execute([$_SESSION['user']['id']]);
            header('Location:panier.php');
        }
    }
        ?>
    </main>
</body>

</html>