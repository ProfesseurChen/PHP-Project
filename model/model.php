<?php

function dbConnect() 
{
	try 
	{
  		$db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));;
  		return $db;
    }
    catch(Exception $e) 
    {
        die('Erreur : '.$e->getMessage());
    }
}

function getTicketsHome() 
{

	$db = dbConnect();

  	$req = $db->query('SELECT * FROM tickets ORDER BY ID DESC LIMIT 0, 2');

  	return $req;
}

function getPostView() {

	$db = dbConnect();

	$postPerPage = 5; #Je veux 5 articles par page
    $postsRequest = $db->query('SELECT id from tickets'); 
    $posts = $postsRequest->rowCount(); #rowCount me permet de compter le nombre de lignes affectées par la dernière requête

    $pages = ceil($posts/$postPerPage); #ceil me permet d'arrondir au nombre entier supérieur le plus proche

    if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pages) {

    $_GET['page'] = intval($_GET['page']);
    $currentPage = $_GET['page'];

    } 

    else 

    {
        $currentPage = 1;
    }

    $start = ($currentPage-1)*$postPerPage; #nombre d'articles total maximum disponible

    $articles = $db->query('SELECT * FROM tickets ORDER BY id DESC LIMIT '.$start.','.$postPerPage);

    return $articles;

}
   
function getFullPost($postId) {

	$db = dbConnect();
	$req = $db->prepare('SELECT id, post, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post FROM tickets WHERE id = ?');
	$req->execute(array($postId));

	$fullpost = $req->fetch();
    
    return $fullpost;
    
}

?>