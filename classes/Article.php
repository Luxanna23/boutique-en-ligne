<?php
require("../includes/config.php");

class Article
{
    // les atributs
    public $id;
    public $titre;
    public $description;
    public $prix;
    public $date;
    public $id_categorie;
    public $quantite;
    public $image;



    // methodes
    public function __construct($titre, $description, $prix, $date, $id_categorie, $quantite, $image)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->prix = $prix;
        $this->date = $date;
        $this->id_categorie = $id_categorie;
        $this->quantite = $quantite;
        $this->image = $image;
    }
   
    function register($bdd){
        $reqArticle = $bdd->prepare('INSERT INTO `articles`(`titre`, `description`, `prix`, `date`, `id_categorie`, `quantite`, `image`) VALUES(?,?,?,?,?,?,?)');
        $reqArticle->execute([$this->titre, $this->description, $this->prix, $this->date, $this->id_categorie, $this->quantite, $this->image]);
    
    }

    public function delete($bdd)
    {
        $req = $bdd->prepare('DELETE FROM `articles` WHERE id=?');
        $req->execute([$this->id]);
        exit;
    }
    public function update(
      
        $bdd
    ) {
        $req = $bdd->prepare("UPDATE `articles` SET titre=?, description=?, image=? WHERE id = ?");
        $req->execute([$this->titre, $this->description, $this->image, $this->id]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }
    public function getQuantite()
    {
        return $this->quantite;
    }
    public function getimage()
    {
        return $this->image;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
    }
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }
    public function setImage($image)
    {
        $this->id = $image;
    }
}

$article = new Article("boucle d'oreille", "bl bl", "4", "2023-02-02", "1", "3", "");
$article->register($bdd);