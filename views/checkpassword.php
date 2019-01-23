<?php 

try {
    $db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
    }
catch(Exception $e) 
    {
    die('Erreur : '.$e->getMessage());
}

$myPseudo = $_POST['my-pseudo'];
$mail = $_POST['my-mail'];
$pass = $_POST['my-password'];
$pass2 = $_POST['my-password2'];

$reqpseudo = $db->prepare("SELECT id FROM account WHERE pseudo = ?");
$reqpseudo->execute(array($myPseudo));
$verif = $reqpseudo->rowCount();


if (empty($myPseudo) || empty($mail) || empty($pass)) {

    echo '<p>Veuillez remplir tous les champs ! Revenir à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} elseif (strlen($myPseudo >= 13) || !preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || strlen($pass >= 17)) {

    echo '<p>Votre pseudo, prénom ou mot de passe sont trop longs et/ou ne sont pas au bon format ! Rententez et revenez à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} elseif ($verif == '1')  {
    
    echo '<p>Ce pseudo existe déjà ! Revenir à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';
    
    $verif->closeCursor();

} elseif ($pass != $pass2) {  
    
    echo '<p>Les mots de passe ne correspondent pas ! Rententez ! Revenir à l\'inscription : <a href="../index.php?action=createLogin">ICI</a></p>';

} else {

    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $req = $db->prepare('INSERT INTO account (pseudo,mail,password) VALUES (:pseudo,:mail,:password)');
    $req->execute(array(
        'pseudo' => $myPseudo,
        'mail' => $mail,
        'password' => $pass_hash));
    
    echo'<p>Votre compte a été créé ! Revenez à la page d\'accueil et connectez-vous : <a href="../index.php">ICI</a></p>';
}
