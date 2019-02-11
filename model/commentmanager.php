<?php

require_once('dbmanager.php');

class CommentManager extends Manager {

    public function getComments($postId) {

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT pseudo, comment FROM comments WHERE id_post = ? ORDER BY id DESC');
		$comments->execute(array($postId));

		return $comments;
    }

} 