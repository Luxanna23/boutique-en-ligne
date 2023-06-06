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
    <title>Document</title>
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
        <?php
        if (isset($_POST["creerCat"])) {
            $titreCat = htmlspecialchars($_POST['titreCat']);
            $imgCat = htmlspecialchars($_POST['imgCat']);
            $categorie = new Categorie($titreCat, $imgCat);
            $categorie->addCategorie($bdd);
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
                let p = document.createElement('p');
                p.innerHTML = '<span>' + resultats.titreCat + '</span> <input type="button" name="deleteCat" data-id ="' + resultats.idCat + '" id="deleteCat' + resultats.idCat + '"><i class="fa-solid fa-trash-can fa-lg"></i></input>' + '</span> <button type="submit" name="editCat" id="editCat' + resultats.idCat + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';
                cats.append(p);


            })
            let submit = document.getElementsByName("deleteCat");
            // console.log(submit.length);
            console.log(submit[0]);

            for (let i = 0; i < 7; i++) {
                console.log(i)
                submit[i].addEventListener('click', () => {
                    let id = submit[i].getAttribute('data-id');
                    // submit[i].id
                    console.log(submit[i]);
                    fetch("traitementPanel.php", {
                        method: "POST",
                        body: JSON.stringify({
                            "idDelete": id
                        })
                    }).then(response => response.json()).then(data => //window.location.reload())
                        console.log(data)).catch(error => console.log(error));
                })
            }

        }).catch(error => console.log(error));
    </script>
</body>

</html>