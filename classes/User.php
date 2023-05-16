<?php

class User
{
    public $id;
    public $email;
    public $password;
    public $firstname;
    public $lastname;

    /* GETTERS */

    function getId()
    {
        return $this->id;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }


    function getFirstname()
    {
        return $this->firstname;
    }

    function getLastname()
    {
        return $this->lastname;
    }


    /* SETTERS */

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    function __construct($email, $password, $firstname, $lastname)
    {
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    function register($bdd)
    {
        if ($this->verifierSiVide()) {
            if ($this->loginUnique($bdd)) {
                $request = $bdd->prepare('INSERT INTO `users`(`email`, `password`, `firstname`, `lastname`) VALUES (?,?,?,?)');
                $request->execute([$this->email, $this->password, $this->firstname, $this->lastname]);
        }
    }}

    function loginUnique($bdd)
    {
        $request = $bdd->prepare('SELECT `email` FROM `users` WHERE email = ?');
        $request->execute([$_POST['email']]);
        if ($request->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }

    function verifierSiVide()
    {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['lastName'])) {
            return true;
        } else {
            echo "Il faut remplir tout les champs";
            return false;
        }
    }

    function connect($bdd)
    {
        $request = $bdd->prepare('SELECT * FROM `users` WHERE email = ? ');
        $request->execute([$this->email]);
        $result = $request->fetch();
        if ($result) {
            $passwordHash = $result['password'];
            if ($request->rowCount() > 0 && password_verify($this->password, $passwordHash)) {
            $_SESSION["user"] = $result;
            }
    }
}

    function disconnect()
    {
        unset($_SESSION["user"]);
        session_destroy();
    }

    function isConnected()
    {
        if (isset($_SESSION["user"])) {
            return true;
        } else {
            return false;
        }
    }

    function update($bdd)
    {
        $request = $bdd->prepare("UPDATE `users` SET `email`= ?,`password`= ?,`first name`= ?,`last name`= ? WHERE id = ?");
        $request->execute([$this->email, $this->password, $this->firstname, $this->lastname, $this->get_id($bdd)]);
        
    }
    function get_id($bdd){
        $request = $bdd->prepare('SELECT `id` FROM `users` WHERE email = ? ');
        $request->execute([$this->email]);
        $result = $request->fetch(); 
        return $result['id'];
    }

}
?>