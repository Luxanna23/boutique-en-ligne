<?php 
require_once('../includes/config.php');
$req = $bdd->prepare('SELECT * FROM `categorie`');
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);


if ($result) {
    foreach ($result as $categorie) {
        $categorieId = $categorie['id'];
        $categorieNom = $categorie['titreCat'];
        
        echo "<ul><li><button onclick=\"window.location.href='categories.php?categorieId=$categorieId'\">$categorieNom</button></li>";
        //echo "<ul><li><input type='radio' name='Categ' id='$categorieId'\">$categorieNom</li>";
        $req2 = $bdd->prepare('SELECT * FROM `souscategorie` WHERE `id_parent` = ?');
        $req2->execute([$categorieId]);
        $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);
        echo "<ul>";
        foreach ($result2 as $Subcategorie) {
            $subCategorieId = $Subcategorie['id'];
            $subCategorieNom = $Subcategorie['titreSousCat'];
            echo "<li><input type='radio' name='subCateg' id='$subCategorieId'\">$subCategorieNom</li>";
        }
        echo "</ul></ul>";
    }
} else {
    echo "Aucune catégorie trouvée.";
}
