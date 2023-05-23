<?php
if(isset($_GET['article_id'])){
//require_once('header.php');
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

    </main>

</body>

</html>
<script>
    console.log('test')
    fetch('detail.php?id=28').then(response => {
        return response.json();
    }).then(data => {
        console.log(data.description);
       let detail= document.createElement("div");
       detail.setAttribute("id", "detail")
    }).catch(err => {console.log(err)});


</script>
<?php } ?>