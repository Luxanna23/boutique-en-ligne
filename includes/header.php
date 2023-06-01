<header>
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

    if ($splitURL[1] === '/index.php' || $splitURL[1] === '/') {
        /* header index */
    ?><div>
            <nav>
                <a href="./index.php">Home</a>
                <?php
                if (isset($_SESSION['user'])) {
                    $user = new User($_SESSION['user']['id'], '', '', '', '', '', '');
                ?>
                    <a href="./php/inscriptionAdresse.php">Form Adresse</a>
                    <a href="./php/categories.php">Categories</a>
                    <a href="./php/panier.php"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></a>
                    <a href="./php/profil.php"><img src=<?= '../php/' . $user->selectAvatar($bdd) ?>></a>
                <?php
                } else { ?>
                    <a href="./php/connexion.php">Connexion</a>
                    <a href="./php/inscription.php">Inscription</a>
                    <a href="./php/categories.php">Categories</a>
                <?php } ?>

                <div>
                    <form method="GET">
                        <input class="bar" type="text" id="search-bar" name="search" placeholder="Rechercher...">
                    </form>

                    <div id="result"></div>
                </div>

            </nav>
        </div>
    <?php } else {
        /* header pages */
    ?>
        <div>
            <nav>
                <a href="../index.php">Home</a>
                <?php
                if (isset($_SESSION['user'])) { ?>
                    <a href="./profil.php">Profil</a>
                    <a href="./inscriptionAdresse.php">Inscription Adresse</a>
                    <a href="./categories.php">Categories</a>
                    <a href="./panier.php">Panier</a>
                    <a href="./deconnexion.php">Deconnexion</a>
                <?php
                } else { ?>
                    <a href="./connexion.php">connexion</a>
                    <a href="./inscription.php">Inscription</a>
                    <a href="./categories.php">Categories</a>
                <?php } ?>

                <div class="search ">
                    <input type="text" id="recherche" class="input form-control me-2" placeholder="Rechercher...">
                    <button class="btn">
                        <i class="fa-solid fa-magnifying-glass fa-xs" aria-hidden="true"></i>
                    </button>
                </div>
            </nav>

        <?php } ?>

</header>