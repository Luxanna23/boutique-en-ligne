<?php
require_once('../classes/Categorie.php');
require_once('../classes/SousCategorie.php');
require_once('../classes/Article.php');
require_once('../includes/config.php');
require_once('../includes/header2.php');
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
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <title>Panel Admin</title>
</head>

<body>

    <main id="panelAdmin">
        <div id="modifCarouselIndex">
        </div>
        <div id="categories">
            <form action="" method="POST">
                <h2>Création de catégorie</h2>
                <input type="text" name="titreCat" id="" placeholder="Nom de la catégorie">
                <input type="text" name="imgCat" id="" placeholder="URL de l'image">
                <button type="submit" name="creerCat">Créer la catégorie</button>
            </form>
        </div>
        <div id="sousCategories">
            <form action="" method="POST">
                <h2>Création de sous-catégorie</h2>
                <input type="text" name="titreSousCat" id="" placeholder="Nom de la sous-catégorie">
                <input type="text" name="imgSousCat" id="" placeholder="URL de l'image">
                <select name="categorie" id="categorie-select" value="categorie">
                    <option selected disabled>Catégorie</option>
                </select>
                <button type="submit" name="creerSousCat">Créer la sous-catégorie</button>
            </form>
        </div>
        <div id="articles">
            <form action="" method="POST">
                <h2>Création d'un article</h2>
                <input type="text" name="titreArt" id="" placeholder="Nom de l'article">
                <textarea name="description" id="" placeholder="Description"></textarea>
                <input type="text" name="prix" id="" placeholder="Prix de l'article">€
                <select name="categories" id="categories-select" value="categorie">
                    <option selected disabled>Catégorie</option>
                </select>
                <select name="sousCategories" id="sousCategories-select" value="sousCategorie">
                    <option selected disabled>Sous-catégorie</option>
                </select>
                <input type="text" name="quantite" id="" placeholder="Quantité">
                <input type="text" name="imgArt" id="" placeholder="URL de l'image">
                <button type="submit" name="creerArt">Créer l'article</button>
            </form>
        </div>


        <?php

        // CREATION DE CATEGORIES
        if (isset($_POST["creerCat"])) {
            $titreCat = htmlspecialchars($_POST['titreCat']);
            $imgCat = htmlspecialchars($_POST['imgCat']);
            $categorie = new Categorie($titreCat, $imgCat);
            $categorie->addCategorie($bdd);
            header("Location: panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
        }
        if (isset($_POST["creerSousCat"])) {
            $titreSousCat = htmlspecialchars($_POST['titreSousCat']);
            $imgSousCat = htmlspecialchars($_POST['imgSousCat']);
            $idParent = htmlspecialchars($_POST['categorie']);
            $souscategorie = new SousCategorie($titreSousCat, $imgSousCat, $idParent);
            $souscategorie->addSousCategorie($bdd);
            header("Location: panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
        }
        if (isset($_POST["creerArt"])) {
            $titreArt = htmlspecialchars($_POST['titreArt']);
            $description = htmlspecialchars($_POST['description']);
            $prix = htmlspecialchars($_POST['prix']);
            $date = date('Y/m/d');
            $categories = htmlspecialchars($_POST['categories']);
            $quantite = htmlspecialchars($_POST['quantite']);
            $sousCatagories = htmlspecialchars($_POST['sousCategories']);
            $imgArt = htmlspecialchars($_POST['imgArt']);
            $article = new Article($titreArt, $description, $prix, $date, $categories, $quantite, $imgArt);
            $article->addArticle($bdd);
            header("Location: panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
        }
        ?>
    </main>
    <script>
        // recupération et affichage des menus select catégorie, dans la création de sous cat et création d'article
        fetch('./recherche.php?panelAdmin=1').then((res) =>
            res.json()
        ).then((data) => {
            data.filter(function(resultats) {
                let select = document.getElementById("categorie-select");
                let select2 = document.getElementById("categories-select");
                let option = document.createElement('option');
                let option2 = document.createElement('option');
                option.setAttribute('value', resultats.idCat);
                option.innerHTML = resultats.titreCat;
                option2.setAttribute('value', resultats.idCat);
                option2.innerHTML = resultats.titreCat;
                select.append(option);
                select2.append(option2);
            });

        })
        // recupération et affichage du menus select sous-catégorie
        fetch('./recherche.php?sousCat=1').then((res) =>
            res.json()
        ).then((data) => {
            data.filter(function(resultats) {
                let select = document.getElementById("sousCategories-select");
                let option = document.createElement('option');
                option.setAttribute('value', resultats.idCat);
                option.innerHTML = resultats.titreSousCat;
                select.append(option);
            });

        })
        //affichage des catégories avec deletion et modification
        fetch('./recherche.php?panelAdmin=1').then(response => {
            return response.json();
        }).then(data => {
            let categories = document.getElementById("categories");
            let cats = document.createElement("div");
            cats.setAttribute("id", "cats");
            categories.append(cats);

            data.filter(function(resultats) {
                console.log(resultats);
                let deleteCat = document.createElement('div');
                let updateCat = document.createElement('div');

                deleteCat.innerHTML = '<span>  <img id="imgCat" src="' + resultats.imgCat + '" alt="">' + resultats.titreCat + '</span> <button class="deleteCat" name="deleteCat" data-id ="' + resultats.idCat + '" id="deleteCat' + resultats.idCat + '"><i class="fa-solid fa-trash-can"></i></button>';
                updateCat.innerHTML = '<input id="imgCat' + resultats.idCat + '"  value="' + resultats.imgCat + '"><input id="titreCat' + resultats.idCat + '" value="' + resultats.titreCat + '"><button class="editCat" name="editCat" data-id ="' + resultats.idCat + '"  id="editCat' + resultats.idCat + '"><i class="fa-regular fa-pen-to-square"></i></button>';

                cats.append(deleteCat);
                cats.append(updateCat);

                let submit = document.getElementsByName("deleteCat");
                // console.log(submit[0]);

                for (let i = 0; i < submit.length; i++) {
                    console.log(i)
                    submit[i].addEventListener('click', () => {
                        let id = submit[i].getAttribute('data-id');
                        // submit[i].id
                        console.log(submit[i]);
                        if (window.confirm("Voulez vous vraiment supprimer la catégorie")) {
                            fetch("traitementPanel.php", {
                                    method: "POST",
                                    body: JSON.stringify({
                                        "idDelete": id,
                                        "action": "delete"
                                    })
                                }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                                .catch(error => console.log(error));
                        }
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
                                headers: {
                                    'Content-type': "multipart/form-data"
                                },
                                body: JSON.stringify({
                                    "titreUpdate": titre,
                                    "imgUpdate": img,
                                    "idUpdate": id2,
                                    "action": "updateSousCat"

                                })
                            }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                            .catch(error => console.log(error));
                    })
                }

            })


        }).catch(error => console.log(error));

        // MODIFICATION DU CAROUSEL EN HAUT DE L'INDEX
        // MODIFIE QUE LE DERNIER ET CHANGE LES AUTRES AC LES INFOS DU DERNIER
        fetch('./recherche.php?carousel=1')
            .then(response => {
                return response.json();
            })
            .then(data => {
                let modifCarouselIndex = document.getElementById("modifCarouselIndex");
                let slide = document.createElement("div");
                slide.setAttribute("id", "slide");
                modifCarouselIndex.append(slide);

                data.filter(function(resultats) {
                    console.log(resultats);
                    let displaySlide = document.createElement('div');
                    let updateSlide = document.createElement('div');

                    displaySlide.innerHTML = '</br><span>  <img class="imgCarousel" id="imgCarousel' + resultats.id + '" src="' + resultats.imgCarousel + '" alt=""><h1>' + resultats.titreCarousel + '</h1> <p>' + resultats.texteCarousel + '</p></span>';
                    updateSlide.innerHTML = '<input id="inputCarousel' + resultats.id + '"  value="' + resultats.imgCarousel + '"><input id="titreCarousel' + resultats.id + '" value="' + resultats.titreCarousel + '"><input id="texteCarousel' + resultats.id + '" value="' + resultats.texteCarousel + '"><button name="editCarousel" data-idCar ="' + resultats.id + '"  id="editCarousel' + resultats.id + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button></br>';

                    slide.append(displaySlide);
                    slide.append(updateSlide);
                });

                let updateCar = document.getElementsByName("editCarousel");
                for (let i = 0; i < updateCar.length; i++) {
                    let id2 = updateCar[i].getAttribute('data-idCar');
                    let imgCarousel = document.getElementById("inputCarousel" + id2);
                    console.log(imgCarousel);
                    updateCar[i].addEventListener('click', () => {
                        let id2 = updateCar[i].getAttribute('data-idCar');
                        let imgCarousel = document.getElementById("inputCarousel" + id2);
                        let titreCarousel = document.getElementById("titreCarousel" + id2);
                        let texteCarousel = document.getElementById("texteCarousel" + id2);
                        let img = imgCarousel.value;
                        console.log(img);
                        let titre = titreCarousel.value;
                        let texte = texteCarousel.value;
                        console.log(img, titre, texte);

                        fetch("traitementPanel.php", {
                                method: "POST",
                                headers: {
                                    'Content-type': "multipart/form-data"
                                },
                                body: JSON.stringify({
                                    "imgUpdate": img,
                                    "titreUpdate": titre,
                                    "texteUpdate": texte,
                                    "idUpdate": id2,
                                    "action": "updateCarousel"
                                })
                            })
                            .then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                            .catch(error => console.log(error));
                    });
                }
            })
            .catch(error => console.log(error));
    </script>
</body>

</html>