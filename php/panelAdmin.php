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
    <title>Document</title>
</head>

<body>
    <main id="panelAdmin">
        <div class="categories">
            <form action="" method="$_POST">
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
            let cat = document.createElement("div");
            cat.setAttribute("id", "cat");
            panelAdmin.append(cat);
            data.filter(function(resultats) {
                console.log(resultats)
                let p = document.createElement('p');
               p.innerText=resultats.titreCat + '<i class="fa-regular fa-trash-can"></i>'; 
               cat.append(p);
            })
        }).catch(error => console.log(error))
    </script>
</body>

</html>