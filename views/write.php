<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
      }
      catch(Exception $e) 
      {
        die('Erreur : '.$e->getMessage());
      }

$req = $bdd->prepare('INSERT INTO tickets(post) VALUES(?)');
$req->execute(array($_POST['elem1']));

header('Location: ../index.php');

?>