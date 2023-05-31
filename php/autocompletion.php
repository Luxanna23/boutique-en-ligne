<?php require('../includes/config.php');
if (isset($_GET['search'])) {
    $req = $bdd->prepare("SELECT `id`, `titreArt` FROM `articles` WHERE titreArt LIKE ?");
    $req->execute(['%' . $_GET['search'] . '%']);
    $res = $req->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($res);
    echo $json;
}

if (isset($_GET['id'])) {
    $request = $bdd->prepare("SELECT * FROM `articles` WHERE `id` = ? ");
    $request->execute([$_GET['id']]);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    echo $json;
}
?>