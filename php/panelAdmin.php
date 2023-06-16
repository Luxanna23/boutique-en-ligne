Gestion des produits à l’aide de back office (Ajout / Suppression /
Modifications de produits, stocks...)
○ Gestion des catégories et des sous catégories de produits (Ajout /
Suppression / Modifications...)
<?php
require_once('../classes/Categorie.php');
require_once('../includes/config.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/panelAdmin.css">
    <script src="https://kit.fontawesome.com/020a26a846.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Panel Admin</title>
</head>

<body>
    <?php
    require_once('../includes/header2.php'); ?>
    <main id="panelAdmin">
        <div class="categories">
            <form action="" method="POST">
                <h2>Création de catégorie</h2>
                <input type="text" name="titreCat" id="" placeholder="Nom de la catégorie">
                <input type="text" name="imgCat" id="" placeholder="URL de l'image">
                <button type="submit" name="creerCat">Créer la catégorie</button>
            </form>
        </div>
        <div class="sousCategories">
            <form action="" method="POST">
                <h2>Création de sous-catégorie</h2>
                <input type="text" name="titreSousCat" id="" placeholder="Nom de la sous-catégorie">
                <input type="text" name="imgSousCat" id="" placeholder="URL de l'image">
                <button type="submit" name="creerSousCat">Créer la sous-catégorie</button>
            </form>
        </div>
        <?php
        // CREATION DE CATEGORIES
        if (isset($_POST["creerCat"])) {
            $titreCat = htmlspecialchars($_POST['titreCat']);
            $imgCat = htmlspecialchars($_POST['imgCat']);
            $categorie = new Categorie($titreCat, $imgCat);
            $categorie->addCategorie($bdd);
            // header("Location: panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
        }

        ?>
    </main>
    <script>
        fetch('./recherche.php?panelAdmin=1').then(response => {
            return response.json();
        }).then(data => {
            let panelAdmin = document.getElementById("panelAdmin");
            let cats = document.createElement("div");
            cats.setAttribute("id", "cats");
            panelAdmin.append(cats);

            data.filter(function(resultats) {
                console.log(resultats);
                let deleteCat = document.createElement('div');
                let updateCat = document.createElement('div');

                deleteCat.innerHTML = '<span>  <img id="imgCat" src="' + resultats.imgCat + '" alt="">' + resultats.titreCat + '</span> <button type="button" name="deleteCat" data-id ="' + resultats.idCat + '" id="deleteCat' + resultats.idCat + '"><i class="fa-solid fa-trash-can fa-lg"></i></button>';
                updateCat.innerHTML = '<input id="imgCat" data-id="'+ resultats.idCat + '" value="' + resultats.imgCat + '"><input id="titreCat"" data-id="' + resultats.idCat + '" value="' + resultats.titreCat + '"><input type="button" name="editCat" data-id ="' + resultats.idCat + '"  id="editCat' + resultats.idCat + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';

                cats.append(deleteCat);
                cats.append(updateCat);


            })
            let submit = document.getElementsByName("deleteCat");
            // console.log(submit[0]);

            for (let i = 0; i < submit.length; i++) {
                console.log(i)
                submit[i].addEventListener('click', () => {
                    let id = submit[i].getAttribute('data-id');
                    // submit[i].id
                    console.log(submit[i]);
                    fetch("traitementPanel.php", {
                        method: "POST",
                        body: JSON.stringify({
                            "idDelete": id,
                            "action":"delete"
                        })
                    }).then(response => response.json()).then(data =>window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                       .catch(error => console.log(error));
                })
            }
            let update = document.getElementsByName("editCat");
            console.log(update[0]);

            for (let i = 0; i < update.length; i++) {
                
                // console.log(imgCat.src, titreCat.value)
                // console.log(update[i].id)
                update[i].addEventListener('click', () => {
                    let imgCat= document.getElementById("imgCat");
                let titreCat= document.getElementById("titreCat");
                    let id2 = update[i].getAttribute('data-id');
                    let img = imgCat.src;
                    let titre = titreCat.value;
                    console.log(id2,img,titre);
                    console.log( JSON.stringify({
                                "titreUpdate": titre,
                                "imgUpdate": img,
                                "idUpdate": id2,

                            }))
                    // submit[i].id
                    console.log(update[i]);
                    fetch("traitementPanel.php", {
                            method: "POST",
                            headers: {'Content-type':"multipart/form-data"},
                            body: JSON.stringify({
                                "titreUpdate": titre,
                                "imgUpdate": img,
                                "idUpdate": id2,
                                "action": "update"

                            })
                        }).then(response => response.json()).then(data =>console.log(data)) // window.location.reload(), permet de voir en direct la suppression
                        .catch(error => console.log(error));
                })
            }

        }).catch(error => console.log(error));
    </script>
</body>

</html>