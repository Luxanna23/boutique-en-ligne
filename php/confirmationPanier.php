<?php

require_once('../stripe/init.php');
require_once('../includes/keyStripe.php');
require_once('../includes/config.php');

\Stripe\Stripe::setApiKey($stripeSecretKey);
$stripe = new \Stripe\StripeClient($stripeSecretKey);

$paymentIntentId = $_GET['payment_intent'];

if ($paymentIntentId) {
    $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

    if ($paymentIntent->status === 'succeeded') {
        $user = json_decode($paymentIntent->metadata->user, true);

        $request = $bdd->prepare('SELECT * FROM `panier` WHERE `id_user` = ?');
        $request->execute([$_SESSION['user']['id']]);
        $cart = $request->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        if ($cart) {
            foreach ($cart as $productInCart) {
                $product_id = $productInCart['id_article'];
                $productRequest = $bdd->prepare('SELECT * FROM `articles` WHERE `idArt` = ?');
                $productRequest->execute([$product_id]);
                $product = $productRequest->fetch(PDO::FETCH_ASSOC);
                $products[] = $product;
            }
        }

        $prixTotal = $paymentIntent->amount / 100;

        $request = $bdd->prepare('INSERT INTO `commande`(`adresse`, `id_user`, `phone`, `date`, `prixTotal`) VALUES (?,?,?,?,?)');
        $request->execute([$user['adresse'], $user['id'], $user['phone'], date('Y-m-d'), $prixTotal]);
        $idcommande = $bdd->lastInsertId();

        // parcourir les produits du panier
        foreach ($products as $product) {
            $articleIDPanier = $product['idArt'];
            $request2 = $bdd->prepare('INSERT INTO `commandpanier`(`id_commande`, `id_article`) VALUES (?,?)');
            $request2->execute([$idcommande, $articleIDPanier]);
        }

        $request3 = $bdd->prepare('DELETE FROM `panier` WHERE `id_user` = (?)');
        $request3->execute([$user['id']]);
    } else {
        header('Location: panier.php');
    }
} else {
    header('Location: panier.php');
}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/checkout.css">
    <link rel="stylesheet" type="text/css" href="../css/panier.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
    <title>Confirmation de commande</title>
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <h1>Confirmation de commande</h1>
    <p>Merci pour votre commande !</p>
    <p>Numéro de commande : <?= $idcommande ?></p>
</body>

</html>