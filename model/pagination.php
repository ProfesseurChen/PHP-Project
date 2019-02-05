<?php 

require_once("dbmanager.php");

class Pagination extends Manager {

    public function countPage() {

        $db = $this->dbConnect();

        $postPerPage = 5; #Je veux 5 articles par page
        $postsRequest = $db->query('SELECT id from tickets'); 
        $posts = $postsRequest->rowCount(); #rowCount me permet de compter le nombre de lignes affectées par la dernière requête

        $pages = ceil($posts/$postPerPage);

        return $page;
    }

    public function myPages() {

        if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pages) {

            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
    
            } 
    
            else 
    
            {
                $currentPage = 1;
            }
        return $currentPage;
    }
}





?>