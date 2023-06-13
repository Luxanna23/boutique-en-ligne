
<?php
function getURL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https";
    else {
        $url = "http";
    }
    // ASSEMBLAGE DE L'URL
    $url .= "://";
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    $splitURL = explode('boutique-en-ligne', $url);
    $splitURL2 = explode('/', $splitURL[1]);
    return [$splitURL, $splitURL2];
}
require_once('config.php');

if (getURL()[0][1] === '/index.php' || getURL()[0][1] === '/') {
    includeHeader($bdd, './', './php/', './maquette/'); //si on est sur l'index, les redirections seront ça
} else {
    includeHeader($bdd, '../', '../php/', '../maquette/'); //si on n'est pas sur l'index, les redirections seront ça
}

function includeHeader($bdd, $index, $urlPHP, $urlMaquette)
{
     ?>
    <header id="allHeader">
        <nav>
            <div class="nav1">
                <!-- LE LOGO -->
                <a href="<?= $index ?>"><img id="logo" src="<?= $urlMaquette ?>logo-removebg.png"></a>
                <!-- LA SEARCH BAR -->
                <div class="search ">
                    <form class="d-flex" role="search" method="GET">
                        <input class="form-control me-2" type="text" id="search-bar" name="search" placeholder="Rechercher...">
                    </form>
                    <div id="result"></div>

                </div>
                <div class="links">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a href="<?= $urlPHP ?>panier.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color: #000000;"></i></a>
                        <a href="<?= $urlPHP ?>profil.php"><i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i></a>
                    <?php } else { ?>
                        <a href="<?= $urlPHP ?>connexion.php">Connexion </a>
                        <a href="<?= $urlPHP ?>inscription.php">Inscription </a>
                    <?php } ?>
                </div>
            </div>    
                <!-- AFFICHAGE DES CATEGORIES ET DES SOUS CATEGORIES -->
            <div>
                <ul id="menu-demo2">
                    <?php
                    $requestCategory = $bdd->prepare('SELECT * FROM categorie');
                    $requestCategory->execute();
                    $resultCategory = $requestCategory->fetchAll(PDO::FETCH_ASSOC);?>
                    <li><a href="<?= $urlPHP ?>categories.php">Toutes les Categories </a></li>
                    <?php foreach ($resultCategory as $categorie) {   
                        $categorieId = $categorie['idCat'];
                        $categorieNom = $categorie['titreCat']; ?>
                        <li>
                        <a href="<?= $urlPHP ?>categories.php?category=<?= $categorieId ?>"><?= $categorieNom; ?></a>
                            <ul><?php
                            $requestSubCategory = $bdd->prepare('SELECT * FROM souscategorie WHERE id_parent = ?');
                            $requestSubCategory->execute([$categorieId]);
                            $resultSubCategory = $requestSubCategory->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($resultSubCategory as $Subcategorie) {
                                $subCategorieId = $Subcategorie['id'];
                                $subCategorieNom = $Subcategorie['titreSousCat'];?> 
                                <li><a href="<?= $urlPHP ?>categories.php?subCategory=<?= $subCategorieId ?>"><?= $subCategorieNom; ?></a></li>
                            <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
<?php } ?>
