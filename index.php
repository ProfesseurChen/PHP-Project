<?php

require('controller/controller.php');

session_start();

try {
	if (isset($_GET['action'])) {

		if ($_GET['action'] == 'indexView') {
					
			homePost();
					
		} elseif ($_GET['action'] == 'login') {

			if (isset($_POST['submit'])) {

				if (empty($_POST['log-pseudo']) || empty($_POST['log-pass'])) {

					throw new Exception('<p>Veuillez compléter tous les champs ! Recommencez : <a href="index.php">ICI</a></p>');

				} else {
					
					$db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');

					$req = $db->prepare('SELECT id FROM account WHERE pseudo = ?');
					$req->execute(array($_POST['log-pseudo']));
					$verif = $req->rowCount();

					if ($verif == 1) {
	
						$req2 = $db->prepare('SELECT password FROM account WHERE pseudo = ?');
						$req2->execute(array($_POST['log-pseudo']));

						$reqverif = $req2->fetch();
						

						if (password_verify($_POST['log-pass'], $reqverif['password'])){
						
							$_SESSION['pseudo'] = $_POST['log-pseudo'];

							header('Location: index.php');

						} else {

							throw new Exception('Le mot de passe est incorrect :(');
						}

					} else {
							
						throw new Exception('<p>Les identifiants ne correspondent pas ! Recommencez : <a href="index.php">ICI</a> ou inscrivez-vous : <a href="index.php?action=createLogin">ICI</a></p>');
	
					}
				}

			} else { 

				throw new Exception('<p>Cette action n\'est pas possible ! Veuillez retouner à l\'accueil: <a href="index.php">ICI</a></p>');

			}

		} elseif ($_GET['action'] == 'addLogin') { 

			$db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
			
			$pseudo = $_POST['my-pseudo'];
			$mail = $_POST['my-mail'];
			$pass = $_POST['my-password'];
			$pass2 = $_POST['my-password2'];

			$reqpseudo = $db->prepare("SELECT * FROM account WHERE pseudo = ?");
			$reqpseudo->execute(array($pseudo));
			$verif = $reqpseudo->rowCount();
			
			if (empty($pseudo) || empty($mail) || empty($pass)) {

				throw new Exception('<p>Veuillez remplir tous les champs ! Revenir à l\'inscription : <a href="index.php?action=createLogin">ICI</a></p>');
			
			} elseif (strlen($pseudo >= 13) || !preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || strlen($pass >= 17)) {
			
				throw new Exception('<p>Votre pseudo, ou mot de passe sont trop longs et/ou ne sont pas au bon format ! Rententez et revenez à l\'inscription : <a href="index.php?action=createLogin">ICI</a></p>');
			
			} elseif ($verif == 1)  {
				
				throw new Exception('<p>Le pseudo existe déjà ! Revenir à l\'inscription : <a href="index.php?action=createLogin">ICI</a></p>');
			
			} elseif ($pass != $pass2) {  
				
				throw new Exception('<p>Les mots de passe ne correspondent pas ! Rententez ! Revenir à l\'inscription : <a href="index.php?action=createLogin">ICI</a></p>');
			
			} else {

				addLogin($pseudo, $mail, $pass);
			}

		} elseif ($_GET['action'] == 'postView') {
					
			getPostView();
					
		} elseif ($_GET['action'] == 'fullPost') {
					
			if (isset($_GET['id']) && $_GET['id'] > 0) {
							
				fullPost();

			} else {
							
				throw new Exception('Ce billet n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a> ');
							
			}
		} elseif ($_GET['action'] == 'updatePost') {

			if(isset($_GET['id']) && $_GET['id'] > 0) {

				updatePost($_GET['id'], $_POST['elem1']);

			} else {

				throw new Exception('Vous ne pouvez pas éditer un billet qui n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}

		} elseif ($_GET['action'] == 'editPost') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

				editPost($_GET['id']);

			} else {

				throw new Exception('Vous ne pouvez pas éditer un billet qui n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}


		} elseif ($_GET['action'] == 'addPost') {

			addPost($_POST['elem1']);

		} elseif ($_GET['action'] == 'writeComments') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

				writeComments($_GET['id'], $_POST['name-comment'], $_POST['comment']);

			} else {

				throw new Exception('Vous ne pouvez pas écrire un commentaire sur un billet qui n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}

		} elseif ($_GET['action'] == 'listMembers') {

			listmember();

		} elseif ($_GET['action'] == 'writePost') {
					
			writeView();
					
		} elseif ($_GET['action'] == 'safeComment') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

				safeComment($_GET['id']);
				
			} else { 
	
				throw new Exception('Erreur : Erreur ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}

		} elseif ($_GET['action'] == 'contactForm') {

			if (isset($_POST['submit'])) {

				if (empty($_POST['contact-name']) || empty($_POST['contact-mail']) || empty($_POST['contact-message'])) {
					
					throw new Exception('Erreur: vous n\'avez pas remplit tout le formulaire ! Recommencez <a href="index.php">ICI</a>');

				} elseif (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['contact-mail'])) {

					addContact($_POST['contact-name'], $_POST['contact-mail'], $_POST['contact-message']);

				} else {

					throw new Exception('Votre mail n\'est pas au bon format ! Recommencez <a href="index.php">ICI</a>');
				}
			} else {

				throw new Exception('Vous ne pouvez pas effectuer l\'action !');
			}

		} elseif ($_GET['action'] == 'createLogin') {
					
			formLogin();
			
		} elseif ($_GET['action'] == 'deleteCom') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

				deleteComment($_GET['id']); 
			} else { 
	
				throw new Exception('Erreur : Vous ne pouvez pas signaler un commentaire qui n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}

		} elseif ($_GET['action'] == 'backoffice') {
			
			backoffice();

		} elseif ($_GET['action'] == 'reportComment') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

				commentReport($_GET['id']);
	
			} else { 
	
				throw new Exception('Erreur : Vous ne pouvez pas signaler un commentaire qui n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}

		} elseif ($_GET['action'] == 'deleteContactMessage') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

				deleteMessage($_GET['id']);
			} else {

				throw new Exception('Vous ne pouvez pas effectuer cette action !');
			}

		} elseif ($_GET['action'] == 'disconnect') {

			disconnect();

		} elseif ($_GET['action'] == 'deletePost') {

			if (isset($_GET['id']) && $_GET['id'] > 0) {

			deletePost($_GET['id']);

			} else { 
	
				throw new Exception('Erreur : Vous ne pouvez pas supprimer cet article ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');
			}

		} else { 

			throw new Exception('Erreur : La page que vous avez demandé n\'existe pas ! Revenez à la page d\'accueil : <a href="index.php">ICI</a>');

		}
	} else {
			
		homePost();

	}
} catch (Exception $e) {

	$errorMessage = $e->getMessage();
	require('views/error.php');

}

?>