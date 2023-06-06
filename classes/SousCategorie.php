<?php
require("../includes/config.php");

class SousCategorie
{
    // les atributs
    public $id;
    public $titreSousCat;
    public $imgSousCat;
    public $id_parent;
   

    // methodes
    public function __construct($titreSousCat, $imgSousCat, $id_parent)
    {
        $this->titreSousCat = $titreSousCat;
        $this->imgSousCat = $imgSousCat;
        $this->id_parent = $id_parent;
    }
    public function addCategorie($bdd)
    {
        $addCategorie = $bdd->prepare('INSERT INTO `categorie`(`titreSousCat`, `imgSousCat`,`id_parent`) VALUES(?,?,?)');
        $addCategorie->execute([$this->titreSousCat, $this->imgSousCat, $this->id_parent]);
    }

    public function delete($bdd)
    {
        $req = $bdd->prepare('DELETE FROM `categorie` WHERE id=?');
        $req->execute([$this->id]);
        exit;
    }
    public function update(
      
        $bdd
    ) {
        $req = $bdd->prepare("UPDATE `categorie` SET titreSousCat=?, imgSousCat=?, id_parent=? WHERE id = ?");
        $req->execute([$this->titreSousCat, $this->imgSousCat, $this->id, $this->id_parent]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitreSousCat()
    {
        return $this->titreSousCat;
    }
    public function getimgSousCat()
    {
        return $this->imgSousCat;
    }
    public function getid_parent()
    {
        return $this->id_parent;
    }
   
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitreSousCat($titreSousCat)
    {
        $this->titreSousCat = $titreSousCat;
    }
    public function setimgSousCat($imgSousCat)
    {
        $this->imgSousCat = $imgSousCat;
    }
    public function setid_parent($id_parent)
    {
        $this->id_parent = $id_parent;
    }
   
}
// $categorie=new Categorie("vélo", "https://just-ebike.com/1183-large_default/velo-electrique-o2feel-vern-urban-power-91.jpg");
// $categorie->addCategorie($bdd);

