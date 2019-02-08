<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
      }
      catch(Exception $e) 
      {
        die('Erreur : '.$e->getMessage());
      }

if (isset($_POST['submitupdate'])) {

$req = $bdd->prepare('UPDATE tickets SET post = ? WHERE id = '.$_GET['id'].'');
$req->execute(array($_POST['elem1']));


header('Location: ../index.php');

} else {
    
    echo '<p>Vous ne pouvez pas effectuer cette action ! Revenez à l\'accueil : <a href="../index.php">ICI</a></p>';
}

?>