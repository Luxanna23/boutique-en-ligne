<?php
// phpinfo(); // pour chopper les infos version etc de mon php
require_once('classes/User.php');
require_once('includes/config.php');
// ob_start('ob_gzhandler'); // contre l'erreur d'header location //


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMYAS Boutique</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/020a26a846.js" crossorigin="anonymous"></script>
</head>

<body>
     <?php
                require_once('includes/header.php'); ?>

    <main>
        <h1>hi</h1>

    </main>
    <?php
    require_once('includes/footer.php'); ?>
</body>

</html>