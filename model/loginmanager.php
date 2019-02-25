<?php

require_once('dbmanager.php');

class LoginManager extends Manager {

    public function newLogin($pseudo, $mail, $password) {

        $db = $this->dbConnect();
        
        $admin = 0;
        $pass_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $req = $db->prepare('INSERT INTO account (pseudo,mail,password,admin) VALUES (:pseudo,:mail,:password,:admin)');
        $req->execute(array(
            'pseudo' => $pseudo,
            'mail' => $mail,
            'password' => $pass_hash,
            'admin' => $admin));
        
        $confirm = '<div class="alert alert-success" role="alert">Votre compte a été créé !</div>';
        return $confirm;

    }

    public function statsLogin() {

        $db = $this->dbConnect();

        $req = $db->query('SELECT * FROM account');
        return $req;
        
    }
}