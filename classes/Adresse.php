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
        $request = $bdd->prepare('INSERT INTO `adresse`(`id_user`, `numero`, `rue`, `codePostal`, `ville`) VALUES (?,?,?,?,?)');
        $request->execute([$this->id_user, $this->numero, $this->rue, $this->codePostal, $this->ville]);
    }

    function isExisting($bdd){
        $request = $bdd->prepare('SELECT `firstname`, `lastname`,`numero`, `rue`, `codePostal`, `ville` FROM `adresse` INNER JOIN users ON adresse.id_user = users.id WHERE users.id = ?');
        $request->execute([$_SESSION['user']['id']]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($request->rowCount() > 0){
            $adresse = $result['firstname'] . " " . $result['lastname'] . '</br>'. $result['numero'] . " " . $result['rue'] . " " . $result['codePostal'] . " " . $result['ville'];
            return $adresse . '<button class="button">Supprimer l\'adresse</button>'; //comment ajouter deleteAdresse($bdd) ????
        }
        else {
            return '<a href="inscriptionAdresse.php"><button class="button">Ajouter une adresse</button></a>';
        }
     }

     function editAdresse($bdd){
        $request = $bdd->prepare("UPDATE `adresse` SET `numero`= ?,`rue`= ?,`codePostal``= ?,`ville`= ? INNER JOIN users ON adresse.id_user = users.id WHERE users.id = ?");
        $request->execute([$this->numero, $this->rue, $this->codePostal, $this->ville, $_SESSION['user']['id']]);
    }

    function deleteAdresse($bdd){
        $request = $bdd->prepare('DELETE FROM `adresse` INNER JOIN users ON adresse.id_user = users.id WHERE users.id = ?');
        $request->execute([$_SESSION['user']['id']]);
    }
}
?>