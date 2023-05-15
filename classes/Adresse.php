<?php 

class Adresse
{
    public $id;
    public $id_user;
    public $numero;
    public $rue;
    public $codePostal;
    public $ville;

function __construct($id_user, $numero, $rue, $codePostal, $ville)
    {
        $this->id_user = $id_user;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
    }


function register($bdd){
    $request2 = $bdd->prepare('INSERT INTO `adresse`(`id_user`, `numero`, `rue`, `codePostal`, `ville`) VALUES (?,?,?,?,?)');
    $request2->execute([$this->id_user, $this->numero, $this->rue, $this->codePostal, $this->ville]);

    }

}
?>