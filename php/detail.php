<?php

require("../includes/config.php"); 


// if (isset($_GET['article_id'])) {
$id = "28";
$requete = $bdd->prepare('SELECT articles.*, categorie.* FROM articles 
INNER JOIN categart ON articles.id = categart.id_article
INNER JOIN categorie  ON categorie.id = categart.id_categorie WHERE articles.id=:id' );
$requete->execute(array('id' => $id));
$result = $requete->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);


?>

