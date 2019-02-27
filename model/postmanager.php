<?php

require_once("dbmanager.php");

class PostManager extends Manager 
{

    public function getTicketsHome() 
    {

        $db = $this->dbConnect();

        $articles = $db->query('SELECT * FROM tickets ORDER BY ID DESC LIMIT 0, 1');
        return $articles;

    }

    public function statsTickets() {

        $db = $this->dbConnect();

        $articles = $db->query('SELECT * FROM tickets');
        return $articles;

    }

    public function getPostView() {

        $db = $this->dbConnect();

        $postPerPage = 6;
        $postsRequest = $db->query('SELECT id from tickets'); 
        $posts = $postsRequest->rowCount();
        $pages = ceil($posts/$postPerPage);

        if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pages) {

            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];

        } else {

            $currentPage = 1;
        }

        $start = ($currentPage-1)*$postPerPage;
        $articles = $db->query('SELECT id, post, DATE_FORMAT(date, \'%d/%m/%Y\') AS date_post FROM tickets ORDER BY id DESC LIMIT '.$start.','.$postPerPage);
        return $articles;

    }
    
    public function getFullPost($postId) {

        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id, post, DATE_FORMAT(date, \'%d/%m/%Y\') AS date_post FROM tickets WHERE id = ?');
        $req->execute(array($postId));
        $fullpost = $req->fetch();        
        return $fullpost;
        
    }

    public function addPost($post) {

        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO tickets(post, date) VALUES(?, NOW())');
        $req->execute(array($post));

        throw new Exception('Votre article a été publié');
    }

    public function deletePost($postId) {

        $db = $this->dbConnect();
        $req = $db->query('DELETE FROM tickets WHERE id = '.$postId.'');
        $confirm = '<div class="alert alert-success" role="alert">Votre article a été supprimé !</div>';
        return $confirm;

        throw new Exception('L\'épisode a bien été supprimé');
    }

    public function updateFullPost($postId, $post) {

        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE tickets SET post = ? WHERE id = '.$postId.'');
        $req->execute(array($post));

        throw new Exception('Votre article a bien été modifié ! Vous pouvez le retrouver: <a href="index.php?action=fullPost&amp;id='.$postId.'">ICI</a>');
    }
}
?>