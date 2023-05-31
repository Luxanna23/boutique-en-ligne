<?php
require_once('../includes/config.php'); 

if (isset($_GET['subCategory'])){
$request = $bdd->prepare("SELECT * FROM articles INNER JOIN categart WHERE categart.id_souscat =  ? AND articles.id = categart.id_article");
$request->execute([$_GET['subCategory']]);
$result = $request->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($result);
echo $json;
}