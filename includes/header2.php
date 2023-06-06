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


$returnCategoryParent = $bdd->prepare('SELECT * FROM categorie');
$returnCategoryParent->execute();
$resultCategoryParent = $returnCategoryParent->fetchAll(PDO::FETCH_OBJ);


if (getURL()[0][1] === '/index.php' || getURL()[0][1] === '/') {
    includeHeader($bdd, './', './php/', './maquette/'); //si on est sur l'index, les redirections seront ça
} else {
    includeHeader($bdd, '../', '../php/', '../maquette/');//si on n'est pas sur l'index, les redirections seront ça
}

function includeHeader($bdd, $index, $urlPHP, $urlMaquette)
{
    $returnCategoryParent = $bdd->prepare('SELECT * FROM categorie');
    $returnCategoryParent->execute();
    $resultCategoryParent = $returnCategoryParent->fetchAll(PDO::FETCH_OBJ); ?>
    <header id="allHeader">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <span class="navbar-brand"><img id="logo" src="<?= $urlMaquette ?>logo-removebg.png"></span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  justify-content-between" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a href="<?= $index ?>">Home </a>
                        <?php
                        if (isset($_SESSION['user'])) {
                            $user = new User($_SESSION['user']['id'], '', '', '', '', '', '');
                        ?>
                            <a href="<?= $urlPHP ?>categories.php">Toutes les Categories </a>
                            <a href="<?= $urlPHP ?>panier.php"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
                            <a href="<?= $urlPHP ?>profil.php"><i class="fa-solid fa-user" style="color: #000000;"></i></a>
                        <?php
                        } else { ?>
                            <a href="<?= $urlPHP ?>connexion.php">Connexion </a>
                            <a href="<?= $urlPHP ?>inscription.php">Inscription </a>
                            <a href="<?= $urlPHP ?>categories.php">Categories </a>
                        <?php } ?>

                        <!-- SEARCH BAR -->
                        <div class="search ">
                            <form class="d-flex" role="search" method="GET">
                                <input class="form-control me-2" type="text" id="search-bar2" name="search" placeholder="Rechercher...">
                            </form>

                            <div id="result2"></div>

                        </div>

                    </div>
                </div>
        </nav> 
    </header>
<?php } ?>