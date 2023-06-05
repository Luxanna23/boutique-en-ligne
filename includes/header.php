<header>
<?php
require_once('config.php'); ?>
    <?php
    // RECUPERER L'URL POUR SAVOIR SI C'EST L'INDEX OU LES AUTRES PAGES
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https";
    else {
        $url = "http";
    }
    // ASSEMBLAGE DE L'URL
    $url .= "://";
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    $splitURL = explode('boutique-en-ligne', $url);  //PHP

// session_start();
// RECUPERER L'URL POUR SAVOIR SI C'EST L'INDEX OU LES AUTRES PAGES
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https";
else {
    $url = "http";
}

// ASSEMBLAGE DE L'URL
$url .= "://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];
$splitURL = explode('boutique-en-ligne', $url);  //PHP

    if ($splitURL[1] === '/index.php' || $splitURL[1] === '/') { ?>


        <!-- HEADER POUR L'INDEX -->


        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <span class="navbar-brand"><img id="logo" src="./maquette/logo-removebg.png"></span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  justify-content-between" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a href="./index.php">Home </a>
                        <?php
                        if (isset($_SESSION['user'])) {
                            $user = new User($_SESSION['user']['id'], '', '', '', '', '', '');
                        ?>
                            <a href="./php/categories.php">Categories </a>
                            <a href="./php/panier.php"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
                            <a href="./php/profil.php"><i class="fa-solid fa-user" style="color: #000000;"></i></a>
                        <?php
                        } else { ?>
                            <a href="./php/connexion.php">Connexion </a>
                            <a href="./php/inscription.php">Inscription </a>
                            <a href="./php/categories.php">Categories </a>
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

    <?php } else { ?>


        <!-- HEADER POUR LES AUTRES PAGES -->



        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <span class="navbar-brand"><img id="logo" src="../maquette/logo-removebg.png"></span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  justify-content-between" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a href="../index.php">Home </a>
                        <?php
                        if (isset($_SESSION['user'])) { ?>
                            <a href="./categories.php">Categories </a>
                            <a href="./panier.php"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
                            <a href="./profil.php"><i class="fa-solid fa-user" style="color: #000000;"></i></a>
                        <?php
                        } else { ?>
                            <a href="./connexion.php">connexion </a>
                            <a href="./inscription.php">Inscription </a>
                            <a href="./categories.php">Categories </a>
                        <?php } ?>

                            <!-- SEARCH BAR -->
                            <div class="search ">
                                <form class="d-flex" role="search" method="GET">
                                    <input class="form-control me-2" type="text" id="search-bar" name="search" placeholder="Rechercher...">
                                </form>

                                <div id="result"></div>

                            </div>

                        </div>
                    </div>
        </nav>

    <?php } ?>

</header>