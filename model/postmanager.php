<?php

require_once("dbmanager.php");

class PostManager extends Manager 
{

    public function getTicketsHome() 
    {

        $db = $this->dbConnect();

        $articles = $db->query('SELECT * FROM tickets ORDER BY ID DESC LIMIT 0, 2');

        return $articles;
    }

    public function getPostView() {  /* Je définis le nombre d'articles par pages et la pagination */

        $db = $this->dbConnect();

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
    
    public function getFullPost($postId) { /* Affiche l'article en pleine page */

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post FROM tickets WHERE id = ?');
        $req->execute(array($postId));

        $fullpost = $req->fetch();
        
        return $fullpost;
        
    }

    public function addPost($post) {

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO tickets(post) VALUES(?)');
        $req->execute(array($post));

    header('Location: ../index.php');
    }

    public function deletePost($postId) {
        $db = $this->dbConnect();

        $req = $db->query('DELETE FROM tickets WHERE id = '.$postId.'');

        $confirm = '<div class="alert alert-success" role="alert">Votre article a été supprimé !</div>';

        return $confirm;

        header('Location: index.php');
    }

    public function updateFullPost($postId, $post) {

        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE tickets SET post = ? WHERE id = '.$postId.'');
        $req->execute(array($post));

        $confirmUpdate = '<div class="alert alert-success" role="alert">Votre article a édité !</div>';

       return $confirmUpdate;

    }
}
?>