<?php
require("../includes/config.php");

class Categorie
{
    // les atributs
    public $id;
    public $titre;
    public $image;
    public $id_parent;
   



    // methodes
    public function __construct($titre, $image, $id_parent)
    {
        $this->titre = $titre;
        $this->image = $image;
        $this->id_parent = $id_parent;
        
    }
    public function addCategorie($bdd)
    {
        $addCategorie = $bdd->prepare('INSERT INTO `categorie`(`titre`, `image`, `id_parent`) VALUES(?,?,?)');
        $addCategorie->execute([$this->titre, $this->image, $this->id_parent]);
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
        $req = $bdd->prepare("UPDATE `categorie` SET titre=?, image=?, id_parent=? WHERE id = ?");
        $req->execute([$this->titre, $this->image, $this->id_parent, $this->id]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getimage()
    {
        return $this->image;
    }
    public function getid_parent()
    {
        return $this->id_parent;
    }
   
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function setimage($image)
    {
        $this->image = $image;
    }
    public function setid_parent($id_parent)
    {
        $this->id_parent = $id_parent;
    }
   
}

// $article = new Article("boucle d'oreille", "bl bl", "4", "2023-02-02", "1", "3", "");
// $article->addArticle($bdd);
