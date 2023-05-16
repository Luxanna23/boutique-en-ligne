<?php
//require_once('../includes/header.php');
require_once('../classes/User.php');
require_once('../includes/config.php');
ob_start('ob_gzhandler');

function submit($bdd)
{
        if (isset($_POST["Envoyer"])) {
        $email = htmlspecialchars($_POST['email']);
        $prenom = htmlspecialchars($_POST['firstName']);
        $nom = htmlspecialchars($_POST['lastName']);
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        if (isCompatible($bdd)) {
            $user = new User('',$email, $passwordHash, $prenom, $nom, 'avatars/default.png');
            $user->register($bdd);
            //$adresse = new Adresse($user);
            header("Location: connexion.php");
        } else {
            echo "Cet email existe deja, utilisez un autre email ou connectez vous si vous avez deja un compte.";
        }
    }
}

submit($bdd);
function isCompatible()
{
    if ($_POST['password'] == $_POST['password2']) {
        return true;
    } else {
        echo "Les deux mots de passe ne sont pas identiques";
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
</head>

<body>
<?php require_once('../includes/header.php'); ?>
    <main>
        <h1>Inscription</h1>

        <form method="post" id="signup">

            <label for="firstName">Prenom</label><br>
            <input type="text" id="firstName" name="firstName" /><br>

            <label for="lastName">Nom</label><br>
            <input type="text" id="lastName" name="lastName" /><br>

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" /><br>


            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" /><br>


            <label for="password2">Confirmez le mot de passe</label><br>
            <input type="password" id="password2" name="password2" /><br>

            <p id="message"></p>

            <input type="submit" name="Envoyer">
        </form>
    </main>

</body>

</html>

<script>
    let prenom = document.querySelector("#firstName");
    let nom = document.querySelector("#lastName");
    let email = document.querySelector("#email");
    let password = document.querySelector("#password");
    let password2 = document.querySelector("#password2");
    let formSignUp = document.querySelector("#signup");
    let message = document.querySelector("#message");

function isSignUp() {
  if (prenom.value == "") {
    document.getElementById("message").innerText = "Le champs prenom ne peut pas être vide.";
    return false;
  } else if (prenom.value.length < 3) {
    document.getElementById("message").innerText = "Le prénom est trop court";
    return false;
  } else if (nom.value == "") {
    document.getElementById("message").innerText = "Le champs nom ne peut pas être vide.";
    return false;
  } else if (nom.value.length < 3) {
    document.getElementById("message").innerText = "Le nom est trop court";
    return false;
  } else if (email.value == "") {
    document.getElementById("message").innerText =
      "Le champs email ne peut pas être vide.";
    return false;
  } else if (password.value == "") {
    document.getElementById("message").innerText =
      "Le champs mot de passe ne peut pas être vide.";
    return false;
  } else if (password2.value == "") {
    document.getElementById("message").innerText =
      "Le champs confirmation de mot de passe ne peut pas être vide.";
    return false;
  } else if (password.value !== password2.value) {
    document.getElementById("message").innerText =
      "Les deux mots de passe ne sont pas identiques.";
    return false;
  } else {
    return true;
  }
}

formSignUp.addEventListener("submit", (e) => {
  if (isSignUp() == false) {
    e.preventDefault();
  }
});

</script>