<?php 
require_once('../includes/config.php');
$req = $bdd->prepare('SELECT * FROM `categorie`, `souscategorie`');
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);
