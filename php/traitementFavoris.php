<?php 
require_once('../includes/config.php');
$req = $bdd->prepare('SELECT * FROM favoris WHERE id_user = ?');
$req->execute([$_SESSION['user']['id']]);
$result = $req->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($result);
echo $json;