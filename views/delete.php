<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
      }
      catch(Exception $e) 
      {
        die('Erreur : '.$e->getMessage());
      }
echo $_GET['id'];

$req = $bdd->query('DELETE FROM tickets WHERE id = '.$_GET['id'].'');

header('Location: index.php');

?>