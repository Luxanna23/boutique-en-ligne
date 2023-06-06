<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
//ob_start('ob_gzhandler');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <script src="../js/affichageCateg.js" defer></script>
    <script src="../js/autocompletion.js" defer></script>
</head>

<body>
    <?php require_once('../includes/header2.php');
     ?>
    <main>
        <?php
        $req = $bdd->prepare('SELECT * FROM `categorie`');
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <div id="container">
            <form action="" method="get">
                <div id="filterDiv"> <?php
                    foreach ($result as $categorie) {
                        $categorieId = $categorie['idCat'];
                        $categorieNom = $categorie['titreCat']; ?>
                        <div class="categoryParentDiv" data-parent-id="<?= $categorieId; ?>">
                            <ul>
                                <li class="resultParent dropdown-toggle" id="<?= $categorieNom; ?>">
                                    <input type="radio" class="category" name="category" id="<?= $categorieId; ?>"><?= $categorieNom; ?>
                                </li>
                                <ul class="categoryChildDiv" id="categoryChildDiv<?= $categorieId; ?>" data-parent-id="<?= $categorieId; ?>">
                                    <?php
                                            $req2 = $bdd->prepare('SELECT * FROM `souscategorie` WHERE `id_parent` = ?');
                                            $req2->execute([$categorieId]);
                                            $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result2 as $Subcategorie) {
                                                $subCategorieId = $Subcategorie['id'];
                                                $subCategorieNom = $Subcategorie['titreSousCat']; ?>
                                        <li id="<?= $subCategorieNom; ?>">
                                            <input type="radio" class="subCategory" name="subCategory" id="<?= $subCategorieId; ?>">
                                            <?= $subCategorieNom; ?>
                                        </li>
                                    <?php
                                            }
                                    ?>
                                </ul>
                            </ul>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </form>
            <div id="allItems">
            </div>
        </div>
    </main>

</body>

</html>