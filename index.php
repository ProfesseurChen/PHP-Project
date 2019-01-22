<?php

#require('model/model.php');

require('controller/controller.php');

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'indexView') {
        
		homePost();
	} 
	elseif ($_GET['action'] == 'postView') {
        
		postView();
        
	} elseif ($_GET['action'] == 'fullPost') {
        
        if (isset($_GET['id']) && $_GET['id'] > 0) {
        fullPost(); } else {
            echo 'Pas de billets ! Revenez à la page d\'accueil : <a href="index.php">ICI</a> ';
        }
    }
	elseif ($_GET['action'] == 'writePost') {
        
		writeView();
	} 
	else { echo 'Erreur : La page que vous avez demandé n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>';
	}
} else {
    
	homePost();
    
}

?>