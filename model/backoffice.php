<?php

require_once('dbmanager.php');

class Backoffice extends Manager {

    public function newComments () {

        $db = $this->dbConnect();
        $comments = $db->query('SELECT * FROM comments ORDER BY ID DESC LIMIT 0, 10');

        return $comments;
        
    } 
    
    public function reportingComment($commentId) {

        $db = $this->dbConnect();

        $reported = $db->prepare('DELETE FROM comments WHERE id = ?');
        $reported->execute(array($commentId));

        $confirmUpdate = '<div class="alert alert-success" role="alert">Votre article a édité !</div>';

        return $confirmUpdate;
    
    }
} 