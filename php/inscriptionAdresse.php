<?php
require_once('../includes/header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start();

function submit($bdd)
{
    if (isset($_POST["Envoyer"])) {
        $id_user = $_SESSION['user']['id'] ;
        $firstname = htmlspecialchars($_POST['prenom']) ;
        $lastname = htmlspecialchars($_POST['nom']) ;
        $numero = htmlspecialchars($_POST['numero']);
        $rue = htmlspecialchars($_POST['rue']);
        $postal = htmlspecialchars($_POST['postal']);
        $ville = htmlspecialchars($_POST['ville']);

        $adresse = new Adresse ($id_user,$firstname, $lastname, $numero, $rue, $postal, $ville);
        if ($adresse->itExist($bdd)){
            $adresse->editAdresse($bdd);
        }
        else {
            $adresse->register($bdd);
        }
        header("Location: profil.php");
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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
</head>

<body>
<?php require_once('../includes/header2.php'); ?>
    <main>
        <h1>Adresse de Livraison</h1>

        <form method="post" id="signup">
            <label for="numero">Nom</label><br>
            <input type="text" id="nom" name="nom" /><br>

            <label for="numero">Prenom</label><br>
            <input type="text" id="prenom" name="prenom" /><br>


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