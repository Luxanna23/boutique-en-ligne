// Requête + traitement 
<?php
require_once('../includes/config.php'); 

$contentJson = (file_get_contents('php://input'));
$_POST = json_decode($contentJson,true);

echo json_encode($_POST);

$requete = $bdd->prepare(' INSERT INTO `panier`(`id_user`, `id_article`) VALUES (?,?)');
$requete->execute(array( $idUser, $idArt));