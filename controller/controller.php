<?php

require('model/model.php');

function homePost() {


	require('views/indexView.php');

}

function postView() {

	$req = getPostView();

	require('views/postView.php');

}

function writeView() {

	require('views/writePost.php');
}

function fullPost() {
    
    $post = getFullPost($_GET['id']);
    
    require('views/fullPost.php');
}

function formLogin() {
    
    require('views/createLogin.php');
}

function disconnect() {

	require('views/disconnect.php');
}