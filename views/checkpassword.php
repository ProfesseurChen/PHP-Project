<?php 

try {
    $db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
    }
catch(Exception $e) 
    {
    die('Erreur : '.$e->getMessage());
}

$pseudo = $_POST['my-pseudo'];
$mail = $_POST['my-mail'];
$pass = $_POST['my-password'];
$pass2 = $_POST['my-password2'];

$reqpseudo = $db->query('SELECT pseudo, mail FROM account');
$verif = $reqpseudo->rowCount();


if (empty($pseudo) || empty($mail) || empty($pass)) {

    echo '<p>Veuillez remplir tous les champs ! Revenir à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} elseif (strlen($pseudo >= 13) || !preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || strlen($pass >= 17)) {

    echo '<p>Votre pseudo, prénom ou mot de passe sont trop longs et/ou ne sont pas au bon format ! Rententez et revenez à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} elseif ($verif == '1')  {
    
    echo '<p>Le pseudo ou le mail existe déjà ! Revenir à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} elseif ($pass != $pass2) {  
    
    echo '<p>Les mots de passe ne correspondent pas ! Rententez ! Revenir à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} else {

    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $req = $db->prepare('INSERT INTO account (pseudo,mail,password) VALUES (:pseudo,:mail,:password)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'mail' => $mail,
        'password' => $pass_hash));
    
    echo'<p>Votre compte a été créé ! Revenez à la page d\'accueil et connectez-vous : <a href="../index.php">ICI</a></p>';
}
