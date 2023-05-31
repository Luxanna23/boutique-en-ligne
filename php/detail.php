<?php

require("../includes/config.php"); 


// if (isset($_GET['article_id'])) {
<<<<<<< HEAD
$id = "12";
$requete = $bdd->prepare('SELECT articles.*, souscategorie.*, categorie.* FROM articles 
INNER JOIN categart ON articles.id = categart.id_article
INNER JOIN souscategorie  ON souscategorie.id = categart.id_categorie
INNER JOIN categorie ON categorie.id=souscategorie.id_parent WHERE articles.id=:id' );
=======
$id = "28";
$requete = $bdd->prepare('SELECT articles.*, categorie.* FROM articles 
INNER JOIN categart ON articles.id = categart.id_article
INNER JOIN categorie  ON categorie.id = categart.id_categorie WHERE articles.id=:id' );
>>>>>>> Yasmine
$requete->execute(array('id' => $id));
$result = $requete->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);


?>

