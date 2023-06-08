<?php
require_once('../includes/config.php'); 

$contentJson = (file_get_contents('php://input'));
$_POST = json_decode($contentJson,true);

if(($_POST["action"]=="delete")){
$requete = $bdd->prepare('DELETE FROM `categorie` WHERE idCat = ?');
$requete->execute(array($_POST["idDelete"]));
$message["statut"]="OK";
echo json_encode($message);
}

if($_POST["action"] === "update"){
    $requete = $bdd->prepare('UPDATE `categorie` SET `titreCat`=?,`imgCat`=? WHERE idCat=?');
    $requete->execute(array($_POST["titreUpdate"], $_POST["imgUpdate"], $_POST["idUpdate"]));
    // var_dump($requete);
    // var_dump($_POST);
    $message["statut"]="OK";
    echo json_encode($message);
    }
    