<?php
<<<<<<< HEAD
if (isset($_GET['article_id'])) {
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
        fetch('detail.php?id=12').then(response => {
            return response.json();
        }).then(data => {
            console.log(data);
            let main = document.querySelector("main");
            let detail = document.createElement("div");
            let img = document.createElement("img");
            let infos = document.createElement("div");
            let cat = document.createElement("h2");
            cat.textContent = data.titreCat+"/"+data.titreSousCat;
            let titrePrix = document.createElement("div");
            titrePrix.setAttribute("id", "titrePrix");
            let titre = document.createElement("h1");
            titre.textContent = data.titreArt;
            let prix = document.createElement("p");
            prix.textContent = data.prix+"€";
            let description = document.createElement("p");
            description.textContent = data.description;
            let buttons = document.createElement("div");
            buttons.setAttribute("id", "buttons");
            let button = document.createElement("button");
            button.textContent = "Ajouter au panier ";
            let favoris = document.createElement("button");
            favoris.innerHTML = "<i class='fa-solid fa-heart fa-2xl'></i>";
            detail.setAttribute("id", "detail");
            infos.setAttribute("id", "infos");
            img.setAttribute("src", data.imgArt);
            main.append(detail);
            detail.append(img);
            detail.append(infos);
            infos.append(cat);
            titrePrix.append(titre);
            titrePrix.append(prix);
            infos.append(titrePrix)
            infos.append(description);
            buttons.append(button); 
            buttons.append(favoris);
            infos.append(buttons);
           

        }).catch(err => {
            console.log(err)
        });
    </script>
=======
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
>>>>>>> Yasmine
<?php } ?>