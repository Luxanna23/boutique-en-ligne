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

if (isset($_POST['submitInfo'])) {
    if (!empty($_POST['email'])) {
        $email = !empty($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
        $log = $_SESSION['email'];
        $request = $bdd->prepare("UPDATE utilisateurs SET email = :email WHERE id = :id");
        $request->execute(["email" => $email, "id" => $_SESSION['id']]);
        $_SESSION['email'] = $email;
        header('refresh:0');
    }
    if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
        if ($_POST['password1'] == $_POST['password2']) {
            $mdp = $_POST['password1'];
            $sql = "UPDATE utilisateurs SET password = ? WHERE id = ?";
            $request = $bdd->prepare($sql);
            $request->execute([$mdp, $id]);
            $result = $request->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $message = "Les deux mots de passe ne sont pas identiques !";
        }
    } else {
        $message = "Il faut remplir tous les champs de mot de passe !";
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

        <form class='form1' method="POST">
                <div class="field">
                    <label>Email </label>
                    <input type="text" name="email" placeholder="<?php echo $_SESSION['user']['email']; ?>">
                </div>

                <div class="field">
                    <label>Prenom</label>
                    <input type="text" name="firstName" placeholder="<?php echo $_SESSION['user']['firstname']; ?>">
                </div>

                <div class="field">
                    <label>Nom </label>
                    <input type="text" name="lastName" placeholder="<?php echo $_SESSION['user']['lastname']; ?>">
                </div>

                <div class="field">
                    <label>Mot de passe</label>
                    <input type="password" name="password1">
                </div>

                <div class="field">
                    <label>Confirmez le mot de passe</label>
                    <input type="password" name="password2">
                </div>

                <input type="submit" name="submitInfo" value="Enregistrer">

                <div>
                    <button class="button"><a href="profil.php">Retour au profil</a></button>
                </div>

                <p id="message"></p>
            </form>
*
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

formSignUp.addEventListener("submitInfo", (e) => {
  if (submitInfo() == false) {
    e.preventDefault();
  }
});

</script>