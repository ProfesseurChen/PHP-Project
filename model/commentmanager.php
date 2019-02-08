<?php

require_once('dbmanager.php');

class CommentManager extends Manager {

    public function getComments($postId) {

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT pseudo, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_date_fr FROM comments WHERE id_post = ? ORDER BY comment_date DESC');
		$comments->execute(array($postId));

		return $comments;
    }

    public function writeComments($postId, $pseudo, $comment) {

        $db = $this->dbConnect();
        $insert = $db->prepare('INSERT INTO comments VALUES(?,?,?, NOW())');
        $insert->execute(array($postId, $pseudo, $comment));

        return $insert;
    }
}