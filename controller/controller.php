<?php

require_once('model/postmanager.php');
require_once('model/pagination.php');
require_once('model/commentmanager.php');
require_once('model/backoffice.php');
require_once('model/loginmanager.php');
require_once('model/contactform.php');



function homePost() {

	
	$postManager = new PostManager();

	$posts = $postManager->getTicketsHome();
	
	require('views/indexView.php');

}

function getPostView() {


	$postManager = new PostManager();
	$paginationManager = new Pagination();

	$pagination = $paginationManager->countPage();
	$post = $postManager->getPostView();

	require('views/postView.php');

}
function addPost($post) {

	$postManager = new Postmanager();

	$addpost = $postManager->addPost($post);
}

function writeView() {

	require('views/writePost.php');
}

function fullPost($postId) {
	
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$comment = $commentManager->getComments($postId);
	$post = $postManager->getFullPost($postId);
	
    
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
	$commentManager = new CommentManager();

	$delete = $postManager->deletePost($postId);
	$deletecom = $commentManager->deleteCommentFromPost($postId);
}

function writeComments($postId, $pseudo, $comment) {

	$comments = new CommentManager();

	$comment = $comments->writeComment($postId, $pseudo, $comment);
}

function backoffice() {

	$comments = new Backoffice();
	$report = new CommentManager();
	$contactformManager = new ContactForm();
	$postmanager = new PostManager();
	$loginmanager = new LoginManager();

	$commentspost = $report->statComment();
	$statslogin = $loginmanager->statsLogin();
	$nbpost = $postmanager->statsTickets();
	$contact = $contactformManager->viewMessage();
	$comment = $comments->newComments();
	$reported = $report->reportedCom();

	require('views/backoffice.php');
}

function addLogin($pseudo, $mail, $pass) {

	$createlogin = new LoginManager();
	
	$create = $createlogin->newLogin($pseudo, $mail, $pass);
}

function updatePost($postId, $post) {

	$postManager = new PostManager();

	$updatePost = $postManager->updateFullPost($postId, $post);
}

function commentReport($commentId) {
	
	$commentManager = new CommentManager();

	$reporting = $commentManager->reportingCom($commentId);

}

function deleteComment($commentId) {

	$backoffice = new Backoffice();

	$deletethis = $backoffice->reportingComment($commentId);

	
}

function safeComment($postId) {

	$commentManager = new CommentManager();

	$itssafe = $commentManager->safeCom($postId);
}

function addContact($pseudo, $mail, $message) {

	$contactformManager = new ContactForm();

	$addmessage = $contactformManager->addMessage($pseudo, $mail, $message);

}

function deleteMessage($postId) {

	$contactformManager = new ContactForm();

	$deletemessage = $contactformManager->deleteMessage($postId);

}