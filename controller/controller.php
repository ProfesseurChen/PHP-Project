<?php

require_once('model/postmanager.php');
require_once('model/pagination.php');
require_once('model/commentmanager.php');
require_once('model/backoffice.php');
require_once('model/loginmanager.php');



function homePost() {

	
	$postManager = new PostManager();
	$posts = $postManager->getTicketsHome();

	require('views/indexView.php');

}

function getPostView() {


	$postManager = new PostManager();
	

	$post = $postManager->getPostView();

	require('views/postView.php');

}
function addPost($post) {

	$postManager = new Postmanager();
	$addpost = $postManager->addPost($post);

	if ($addpost === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php');
    }
}

function writeView() {

	require('views/writePost.php');
}

function fullPost() {
	
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$comment = $commentManager->getComments($_GET['id']);

	$post = $postManager->getFullPost($_GET['id']);
	
    
    require('views/fullPost.php');
}

function editPost($postId) {

	$postManager = new PostManager();
	$post = $postManager->getFullPost($postId);

	require('views/editPost.php');

}

function formLogin() {
    
    require('views/createLogin.php');
}

function disconnect() {
	
	require('views/disconnect.php');
}

function deletePost($postId) {

	$postManager = new PostManager();
	$delete = $postManager->deletePost($postId);

	if ($delete === false) {
        throw new Exception('Impossible de supprimer le poste !');
    }
    else {
        header('Location: index.php');
    }

}

function writeComments($postId, $pseudo, $comment) {

	$comments = new CommentManager();
	$comment = $comments->writeComment($postId, $pseudo, $comment);

	if ($create === false) {
        throw new Exception('Impossible de commenter !');
    }
    else {
		header('Location: index.php?action=fullPost&id=' . $postId);
	}	
}

function backoffice() {

	$comments = new Backoffice();
	$report = new CommentManager();

	$comment = $comments->newComments();
	$reported = $report->reportedCom();

	require('views/backoffice.php');
}

function addLogin($pseudo, $mail, $pass) {

	$createlogin = new LoginManager();
	$create = $createlogin->newLogin($pseudo, $mail, $pass);

	if ($create === false) {
        throw new Exception('Impossible de créer le compte !');
    }
    else {
        header('Location: index.php');
	}
}
function updatePost($postId, $post) {

	$postManager = new PostManager();

	$updatePost = $postManager->updateFullPost($postId, $post);

	if ($updatPost === false) {
		throw new Exception('Impossible de modifier l\'article !');
    }
    else {
		header('Location: index.php?action=fullPost&id=' .$postId. '');
	}
}

function commentReport($commentId) {
	
	$commentManager = new CommentManager();

	$reporting = $commentManager->reportingCom($commentId);

	if ($reporting === false) {
		throw new Exception('Impossible de modifier l\'article !');
    }
    else {
		header('Location: index.php');
	}
}

function deleteComment($commentId) {

	$backoffice = new Backoffice();

	$deletethis = $backoffice->reportingComment($commentId);

	if ($deletethis === false) {

		throw new Exception('Impossible de supprimer le commentaire !');

    }
    else {
		header('Location: index.php');
	}
}