<?php

require_once('dbmanager.php');

class LoginManager extends Manager {

    public function newLogin($pseudo, $mail, $password) {

        $db = $this->dbConnect();
        
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $req = $db->prepare('INSERT INTO account (pseudo,mail,password) VALUES (:pseudo,:mail,:password)');
        $req->execute(array(
            'pseudo' => $pseudo,
            'mail' => $mail,
            'password' => $pass_hash));
        
        $confirm = '<div class="alert alert-success" role="alert">Votre compte a été créé !</div>';

        return $confirm;

    }

    public function statsLogin() {

        $db = $this->dbConnect();

        $req = $db->query('SELECT * FROM account');

        return $req;
    }
}