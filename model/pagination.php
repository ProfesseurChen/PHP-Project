<?php 

require_once("dbmanager.php");

class Pagination extends Manager {

    public $postPerPage = 6;

    public function countPage() {

        $db = $this->dbConnect();

        $postsRequest = $db->query('SELECT id from tickets'); 
        $posts = $postsRequest->rowCount();
        
        return $posts;
    }
}





?>