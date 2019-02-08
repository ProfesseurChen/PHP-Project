<?php

require_once('model/postmanager.php');
require_once('model/pagination.php');
require_once('model/commentmanager.php');



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

function writeView() {

	require('views/writePost.php');
}

function fullPost() {
	
	$postManager = new PostManager();
	$commentManager = new CommentManager();
	$post = $postManager->getFullPost($_GET['id']);
	$comments = $commentManager->getComments($_GET['id']);
    
    require('views/fullPost.php');
}

function editPost() {

	$postManager = new PostManager();
	$post = $postManager->getFullPost($_GET['id']);

	require('views/editPost.php');

}

function formLogin() {
    
    require('views/createLogin.php');
}

function disconnect() {
	
	require('views/disconnect.php');
}

function delete() {

	require('views/delete.php');
}

function writeComments($postId, $pseudo, $comment)
{
	$comments = new CommentManager();
	$comment = $comments->writeComments($postId, $pseudo, $comment);
	
    header('Location: index.php?action=fullPost&id=' . $postId);
}