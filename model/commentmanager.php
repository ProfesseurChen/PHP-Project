<?php

require_once('dbmanager.php');

class CommentManager extends Manager {

    public function getComments($postId) {

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, pseudo, comment FROM comments WHERE id_post = ? ORDER BY id DESC');
		$comments->execute(array($postId));

		return $comments;
    }

    public function reportingCom($commentId) {

        $db = $this->dbConnect();
        
        $valuereport = 1;

        $comments = $db->prepare('UPDATE comments SET report = ? WHERE id = '.$commentId.'');
        $comments->execute(array($valuereport));

        return $comments;
    }

    public function reportedCom() {

        $db = $this->dbConnect();

        $reported = $db->query('SELECT * FROM comments WHERE report= 1');

        return $reported;
    }

    public function writeComment($postId, $pseudo, $comment) {

        $db = $this->dbConnect();

        $report = 0;
        $req = $db->prepare('INSERT INTO comments(id_post, pseudo, comment, report) VALUES(:idpost, :pseudo, :comment, :report)');
        $req->execute(array(
        'idpost' => $postId, 
        'pseudo' => $pseudo, 
        'comment' => $comment,
        'report' => $report));

        return $req;
    }

    public function deleteCommentFromPost($postId) {

        $db = $this->dbConnect();

        $delete = $db->prepare("DELETE FROM comments WHERE id_post = ?");
        $delete->execute(array($postId));

        return $delete;
    }

    public function safeCom($postId) {

        $db = $this->dbConnect();

        $report = 0;

        $comment = $db->prepare("UPDATE comments SET report = ? WHERE id = ?");
        $comment->execute(array($report, $postId));

        return $comment;

    }

} 