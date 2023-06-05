<?php
session_start();
// try{
    $bdd = new PDO("mysql:host=localhost;dbname=boutique", 'root', '');
    // $this->bd = new PDO("mysql:host=localhost;dbname=classes;charset=utf8mb4", "root", ""); marche aussi
    // même sans le charset, la bdd ne se connecte pas
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
// }catch (PDOException $e){
//     echo "Connection failed: " . $e->getMessage();
// }

?>
