<?php

require_once('model/postmanager.php');



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
    $post = $postManager->getFullPost($_GET['id']);
    
    require('views/fullPost.php');
}

function formLogin() {
    
    require('views/createLogin.php');
}

function disconnect() {
	
	require('views/disconnect.php');
}