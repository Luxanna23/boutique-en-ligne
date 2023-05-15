<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start('ob_gzhandler');

function submit($bdd)
{
    var_dump($_SESSION);
    if (isset($_POST["Envoyer"])) {
        $numero = htmlspecialchars($_POST['numero']);
        $id_user = $_SESSION['user']['id'] ;
        $rue = htmlspecialchars($_POST['rue']);
        $postal = htmlspecialchars($_POST['postal']);
        $ville = htmlspecialchars($_POST['ville']);
        
            $adresse = new Adresse ($id_user,$numero, $rue, $postal, $ville);
            $adresse->register($bdd);
            //header("Location: connexion.php");
        
    }
}

submit($bdd);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="inscription.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
</head>

<body>

    <main>
        <h1>Adresse</h1>

        <form method="post" id="signup">

            <label for="numero">Numero de voie</label><br>
            <input type="text" id="numero" name="numero" /><br>

            <label for="rue">Nom de la voie</label><br>
            <input type="text" id="rue" name="rue" /><br>

            <label for="postal">Code Postal</label><br>
            <input type="text" id="postal" name="postal" /><br>

            <label for="password2">Ville</label><br>
            <input type="text" id="ville" name="ville" /><br>

            <input type="submit" name="Envoyer" id="button">

        </form>
    </main>

</body>

</html>