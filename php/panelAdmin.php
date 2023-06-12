Gestion des produits à l’aide de back office (Ajout / Suppression /
Modifications de produits, stocks...)
○ Gestion des catégories et des sous catégories de produits (Ajout /
Suppression / Modifications...)
<?php
require_once('../classes/Categorie.php');
require_once('../classes/SousCategorie.php');
require_once('../classes/Article.php');
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
    <title>Document</title>
</head>

<body>
    <?php
    // require_once('../includes/header.php'); ?>
    <main id="panelAdmin">
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
            $date = date('Y-m-d');
            $categories = "vroom";
            // $categories = htmlspecialchars($_POST['categories']);
            $quantite = htmlspecialchars($_POST['quantite']);
            // $sousCatagories = htmlspecialchars($_POST['sousCategories']);
            $imgArt=htmlspecialchars($_POST['imgArt']);
            $article = new Article($titreArt,$description,$prix,$date,$categories,$quantite,$imgArt);
            $article->addArticle($bdd);
            // header("Location: panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
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

                deleteCat.innerHTML = '<span>  <img id="imgCat" src="' + resultats.imgCat + '" alt="">' + resultats.titreCat + '</span> <button type="button" name="deleteCat" data-id ="' + resultats.idCat + '" id="deleteCat' + resultats.idCat + '"><i class="fa-solid fa-trash-can fa-lg"></i></button>';
                updateCat.innerHTML = '<input id="imgCat' + resultats.idCat + '"  value="' + resultats.imgCat + '"><input id="titreCat' + resultats.idCat + '" value="' + resultats.titreCat + '"><input type="button" name="editCat" data-id ="' + resultats.idCat + '"  id="editCat' + resultats.idCat + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';

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
                        let imgCat = document.getElementById("imgCat" + resultats.idCat);
                        let titreCat = document.getElementById("titreCat" + resultats.idCat);
                        console.log(titreCat);
                        let id2 = update[i].getAttribute('data-id');
                        let img = imgCat.value;
                        let titre = titreCat.value;
                        console.log(id2, img, titre);
                        console.log(JSON.stringify({
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
                                    "action": "update"

                                })
                            }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                            .catch(error => console.log(error));
                    })
                }

            })


        }).catch(error => console.log(error));

//affichage des sous-catégories avec deletion et modification
        fetch('./recherche.php?sousCat=1').then(response => {
            return response.json();
        }).then(data => {
            let categories = document.getElementById("sousCategories");
            // console.log(categories);
            let sousCats = document.createElement("div");
            sousCats.setAttribute("id", "cats");
            categories.append(sousCats);

            data.filter(function(resultats) {
                console.log(resultats);
                let deleteCat = document.createElement('div');
                let updateCat = document.createElement('div');

                deleteCat.innerHTML = '<span>  <img id="imgSousCat" src="' + resultats.imgSousCat + '" alt="">' + resultats.titreSousCat + '</span> <button type="button" name="deleteSousCat" data-id ="' + resultats.id + '" id="deleteSousCat' + resultats.id + '"><i class="fa-solid fa-trash-can fa-lg"></i></button>';
                updateCat.innerHTML = '<input id="imgSousCat' + resultats.id + '"  value="' + resultats.imgSousCat + '"><input id="titreSousCat' + resultats.id + '" value="' + resultats.titreSousCat + '"><input type="button" name="editSousCat" data-id ="' + resultats.id + '"  id="editSousCat' + resultats.id + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';

                sousCats.append(deleteCat);
                sousCats.append(updateCat);

                let submit = document.getElementsByName("deleteSousCat");
                // console.log(submit[0]);
                for (let i = 0; i < submit.length; i++) {
                    console.log(i)
                    submit[i].addEventListener('click', () => {
                        let id = submit[i].getAttribute('data-id');
                        // submit[i].id
                        console.log(submit[i]);
                        if (window.confirm("Voulez vous vraiment supprimer la sous-catégorie")) {
                            fetch("traitementPanel.php", {
                                    method: "POST",
                                    body: JSON.stringify({
                                        "idDelete": id,
                                        "action": "deleteSousCat"
                                    })
                                }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                                .catch(error => console.log(error));
                        }
                    })
                }
                let update = document.getElementsByName("editSousCat");
                console.log(update[0]);

                for (let i = 0; i < update.length; i++) {
                    update[i].addEventListener('click', () => {
                        let imgSousCat = document.getElementById("imgSousCat" + resultats.id);
                        let titreSousCat = document.getElementById("titreSousCat" + resultats.id);
                        let id2 = update[i].getAttribute('data-id');
                        let img = imgSousCat.value;
                        let titre = titreSousCat.value;
                        console.log(id2, img, titre);
                        console.log(JSON.stringify({
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
    </script>
</body>

</html>