<?php
require_once('../includes/config.php');
if (isset($_GET['article_id'])) {
?>
    <!DOCTYPE html>
    <html lang="fr" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
        <script src="../js/fonction.js" defer></script>
    </head>

    <body>
        <?php require_once('../includes/header.php'); ?>
        <main id="mainDetail">
            <?php var_dump($_SESSION); ?>
        </main>

    </body>
    <?php

    if (isset($_SESSION["user"])) { ?>
        <input type="hidden" id="user_id" value="<?php $_SESSION['user']['id'] ?>">

<?php } else {
    echo "Vous devez être connecté pour pouvoir ajouter au panier";
}
?>

    </html>
    <script>
        let id = window.location.href.split('=');
        console.log(window.location.href);
        console.log(id[1])
        fetch('recherche.php?id=' + id[1]).then(response => {
            return response.json();
        }).then(data => {
            console.log(data);
            let main = document.getElementById("mainDetail");
            main.setAttribute("class", "mainDetail")
            let detail = document.createElement("div");
            let img = document.createElement("img");
            let infos = document.createElement("div");
            let cat = document.createElement("h2");
            cat.textContent = data.titreCat + "/" + data.titreSousCat;
            let titrePrix = document.createElement("div");
            titrePrix.setAttribute("id", "titrePrix");
            let titre = document.createElement("h1");
            titre.textContent = data.titreArt;
            let prix = document.createElement("p");
            prix.textContent = data.prix + "€";
            let description = document.createElement("p");
            description.textContent = data.description;
            let form = document.createElement("form");
            let button = document.createElement("button");
            button.setAttribute("id", "panier");
            button.setAttribute("name", "AjouterPanier");
            button.setAttribute("value", data.idArt);
            button.textContent = "Ajouter au panier ";
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
            form.append(button);
            infos.append(form);
            // let button = document.getElementById('panier');
            console.log(button)
            let id_user = document.getElementById('user_id').value;
            console.log(id_user)

            button.addEventListener('click', () => {
                // console.log($_GET["AjouterPanier"])
                let formData = {
                    'idArt': this.value,
                    'id_user': id_user
                }
                fetch('traitementTest.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'multipart/form-data',
                    },
                    body: JSON.stringify(formData),
                }).then(resp => {
                    resp.json()
                }).then(data => {
                    console.log(data)
                }).catch(err => {
                    console.log(err)
                })

            })

        }).catch(err => {
            console.log(err)
        });

        // document.addEventListener('DOMContentLoaded', () => {
        // let button = document.getElementById('panier');
        // console.log(button)
        // let id_user = document.getElementById('user_id').value;
        // console.log(id_user)

        // button.addEventListener('click', () => {
        //     console.log($_POST["panier"])
        //     let formData = {
        //         'idArt': this.value,
        //         'id_user': id_user
        //     }
        //     fetch('traitementTest.php', {
        //         method: 'POST',
        //         headers: {
        //             'Content-type': 'multipart/form-data',
        //         },
        //         body: JSON.stringify(formData),
        //     }).then(resp => {
        //         resp.json()
        //     }).then(data => {
        //         console.log(data)
        //     }).catch(err => {
        //         console.log(err)
        //     })

        // })

        // })
    </script>
    <?php 
}
?>