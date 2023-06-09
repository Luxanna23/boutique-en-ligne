<?php
require_once('../classes/User.php');
require_once('../includes/config.php');
ob_start();

 $msg = '';
if (isset($_POST["Envoyer"])) {
    $email = htmlspecialchars($_POST['email']);
    $prenom = '';
    $nom = '';
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $user = new User('', $email, $password, $prenom, $nom, '', '');
        $user->connect($bdd);
        if ($user->isConnected()) {
            header("Location: ../index.php");
        } else {
            $msg = "l'email et le mot de passe ne correspondent pas.";
        }
    } else {
        $msg = "Veuillez remplir tout les champs.";
    }
}


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
    <script src="../js/connexion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <main>
        <h1>Connexion</h1>

        <form method="post" id="login">

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" /><br>


            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" /><br>

            <p id="message"><?= $msg ?></p>

            <input type="submit" name="Envoyer">

        </form>
        <span>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></span>
    </main>

</body>

</html>

<!-- <script>
    let email = document.querySelector("#email");
    let password = document.querySelector("#password");
    let message = document.querySelector("#message");
    let signup = document.querySelector("#login");

    function isLogin() {
        if (email.value == "") {
            document.getElementById("message").innerText = "Le champs email ne peut pas être vide.";
            return false;
        } else if (password.value == "") {
            document.getElementById("message").innerText = "Le champs mot de passe ne peut pas être vide.";
            return false;
        } else {
            return true;
        }
    }
    login.addEventListener("submit", (e) => {
        if (isLogin() == false) {
            e.preventDefault();
        }
    });
</script> -->