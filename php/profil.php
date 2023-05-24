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
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/favoris.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once('../includes/header.php'); ?>
    <main>
        <h1>Profil</h1>
        <?php $user = new User($_SESSION['user']['id'],$_SESSION['user']['email'],$_SESSION['user']['password'], $_SESSION['user']['firstname'], $_SESSION['user']['lastname'], ''); ?>
        <img id="imageProfil" src="<?= $user->selectAvatar($bdd) ?>" >

        <h3><?= $user->getFirstname() . " " . $user->getLastname()?></h3>
        <p><?= $user->getEmail() ?></p>

        <div class="editprofil">
            <a href="profiledit.php"><button class="button">Editer mon profil</button></a>
            <a href="deconnexion.php"><button class="button">Se déconnecter</button></a>
        </div>

        <div>
            <h3>Adresse de livraison : </h3>
            <?php $adresse = new Adresse($_SESSION['user']['id'],'','','',''); 
            echo $adresse->isExisting($bdd); ?>
        </div>

        <div>
            <h3>Liste de souhaits : </h3>
            <div id="list_favoris">
            </div>
        </div>
        
    </main>

</body>

</html>