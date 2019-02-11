<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
        }
        catch(Exception $e) 
        {
          die('Erreur : '.$e->getMessage());
        }

$report = 0;
$req = $bdd->prepare('INSERT INTO comments(id_post, pseudo, comment, report) VALUES(:idpost, :pseudo, :comment, :report)');
$req->execute(array(
    'idpost' => $_POST['idpost'], 
    'pseudo' => $_POST['name-comment'], 
    'comment' => $_POST['comment'],
    'report' => $report));

header('Location: ../index.php?action=fullPost&id=' .$_POST['idpost']. '' );

?>