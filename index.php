<?php

require('controller/controller.php');


if (isset($_GET['action'])) {
	if ($_GET['action'] == 'indexView') {
        
		homePost();
        
	} 
	elseif ($_GET['action'] == 'postView') {
        
		getPostView();
        
	} elseif ($_GET['action'] == 'fullPost') {
        
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            
		fullPost(); 

		} else {
            
            echo 'Ce billet n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a> ';
            
        }
    } elseif ($_GET['action'] == 'editPost') {

		if(isset($_GET['id']) && $_GET['id'] > 0) {

			editPost();

		} else {

			echo 'Vous ne pouvez pas éditer un billet qui n\'existe pas !';
		}

	} elseif ($_GET['action'] == 'writeComments') { 

		if(isset($_GET['id']) && $_GET['id'] > 0) {

			writeComments($_GET['id'], $_POST['name-comment'], $_POST['comment']);
		}

	} elseif ($_GET['action'] == 'writePost') {
        
		writeView();
        
	} elseif ($_GET['action'] == 'createLogin') {
        
		formLogin();
		
	} elseif ($_GET['action'] == 'disconnect') {

		disconnect();
    } elseif ($_GET['action'] == 'delete') {

		delete();
	} else { 
		echo 'Erreur : La page que vous avez demandé n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>';
	}
} else {
    
	homePost();
}

?>