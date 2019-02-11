<?php

require_once('dbmanager.php');

class Backoffice extends Manager {

    public function newComments () {

        $db = $this->dbConnect();
        $comments = $db->query('SELECT * FROM comments ORDER BY ID DESC LIMIT 0, 10');

        return $comments;
        
    } public function reportComment () {
    
    }
} 