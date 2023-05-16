<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start('ob_gzhandler');


if (isset($_FILES['photo']['tmp_name'])) {
    $retour = copy($_FILES['photo']['tmp_name'], $_FILES['photo']['name']);
    if ($retour) {
        $avatar = $_FILES['photo']['name'];
        $user = new User($_SESSION['user']['id'],'','', '', '', $avatar);
        $user->addAvatar($bdd);
        echo '<p>La photo a bien été enregistré.</p>';
        //echo '<img src="' . $_FILES['photo']['name'] . '">';
        move_uploaded_file($_FILES["photo"]["tmp_name"],'./avatars/'.$_SESSION['user']['id'].'.'.pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION));
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once('../includes/header.php'); ?>
    <main>
        <h1>Profil</h1>
        <?php $user = new User($_SESSION['user']['id'],'','', '', '', ''); ?>
        <img id="imageProfil" src="<?= $user->selectAvatar($bdd) ?>" >

        <form method="post" enctype="multipart/form-data">
            <input type="file" name="photo">
            <input type="submit" name="submitAvatar">
        </form>
    </main>

</body>

</html>