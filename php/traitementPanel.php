<?php
require_once('../includes/config.php');

$contentJson = (file_get_contents('php://input'));
$_POST = json_decode($contentJson, true);

if (($_POST["action"] == "delete")) {
    $requete = $bdd->prepare('DELETE FROM `categorie` WHERE idCat = ?');
    $requete->execute(array($_POST["idDelete"]));
    $message["statut"] = "OK";
    echo json_encode($message);
}

if ($_POST["action"] === "update") {
    $requete = $bdd->prepare('UPDATE `categorie` SET `titreCat`=?,`imgCat`=? WHERE idCat=?');
    $requete->execute(array($_POST["titreUpdate"], $_POST["imgUpdate"], $_POST["idUpdate"]));
    // var_dump($requete);
    // var_dump($_POST);
    $message["statut"] = "OK";
    echo json_encode($message);
}
if (($_POST["action"] == "deleteSousCat")) {
    $requete = $bdd->prepare('DELETE FROM `souscategorie` WHERE id = ?');
    $requete->execute(array($_POST["idDelete"]));
    $message["statut"] = "OK";
    echo json_encode($message);
}

if ($_POST["action"] === "updateSousCat") {
    $requete = $bdd->prepare('UPDATE `souscategorie` SET `titreSousCat`=?,`imgSousCat`=? WHERE id=?');
    $requete->execute(array($_POST["titreUpdate"], $_POST["imgUpdate"], $_POST["idUpdate"]));
    // var_dump($requete);
    // var_dump($_POST);
    $message["statut"] = "OK";
    echo json_encode($message);
}

if ($_POST["action"] === "updateCarousel") {
    $requete = $bdd->prepare('UPDATE `carousel` SET `imgCarousel`=?, `titreCarousel`=?,`texteCarousel`=? WHERE id=?');
    $requete->execute(array( $_POST["imgUpdate"], $_POST["titreUpdate"], $_POST["texteUpdate"], $_POST["idUpdate"]));
    $message["statut"] = "OK";
    echo json_encode($message);
}