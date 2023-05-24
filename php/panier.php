<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
//ob_start('ob_gzhandler');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once('../includes/header.php'); ?>
    <main>
        <h1>Mon Panier</h1>
        <div id="panier">
            <?php
            $somme = 0;
            $livraison = 4.99;
            $req = $bdd->prepare('SELECT * FROM `panier` WHERE `id_user` = ?');
            $req->execute([$_SESSION['user']['id']]);
            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                // Afficher les produits du panier
                foreach ($result as $produit) {
                    $articleIDPanier = $produit['id_article'];

                    // Récupérer les informations de l'article depuis la base de données
                    $req2 = $bdd->prepare('SELECT * FROM `articles` WHERE `id` = ?');
                    $req2->execute([$articleIDPanier]);
                    $result2 = $req2->fetch(PDO::FETCH_ASSOC);
                    $somme += $result2['prix'];
                    echo "<img src='" . $result2['imgArt'] . " '><span>" . $result2['titreArt'] . " - Prix : " . $result2['prix'] . "$</span></br>";
                }
                echo "<span>Sous total : " . $somme . "$</span></br>
            <span>Frais de livraison : 4,99$ </span></br>
            <span>Total : " . ($somme + $livraison) . "$</span>";
            } else {
                echo "<p>Panier vide</p>";
                $somme = 0;
            }

            ?>
        </div>
        <div><span>Adresse de livraison :</span>
            <?php $adresse = new Adresse($_SESSION['user']['id'], '', '', '', '');
            echo $adresse->isExisting($bdd); ?>
        </div>
        <div>$*** PAYEMENT ***</div>
        <button name="validerPanier">Valider le panier</button>
    </main>
</body>

</html>