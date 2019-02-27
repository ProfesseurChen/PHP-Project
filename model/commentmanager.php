<?php

require_once('dbmanager.php');

class CommentManager extends Manager {

    public function getComments($postId) {

        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, pseudo, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%im\') AS date_comment FROM comments WHERE id_post = ? ORDER BY id DESC');
		$comments->execute(array($postId));
        return $comments;
        
    }

    public function reportingCom($commentId) {

        $db = $this->dbConnect();
        
        $valuereport = 1;

        $comments = $db->prepare('UPDATE comments SET report = ? WHERE id = '.$commentId.'');
        $comments->execute(array($valuereport));
        throw new Exception('Votre commentaire a bien été signalé !');

    }

    public function reportedCom() {

        $db = $this->dbConnect();

        $reported = $db->query('SELECT * FROM comments WHERE report= 1');
        return $reported;

    }

    public function writeComment($postId, $pseudo, $comment) {

        $db = $this->dbConnect();

        $report = 0;
        $req = $db->prepare('INSERT INTO comments(id_post, pseudo, comment, comment_date, report) VALUES(:idpost, :pseudo, :comment, NOW(), :report)');
        $req->execute(array(
        'idpost' => $postId, 
        'pseudo' => $pseudo, 
        'comment' => $comment,
        'report' => $report));
        
        throw new Exception('Votre commentaire a bien été ajouté ! Revenez à l\'épisode: <a href="index.php?action=fullPost&amp;id='.$postId.'">ICI</a>');
        
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
        
        throw new Exception('Le commentaire signalé a bien été modéré !');

    }

    public function statComment() {

        $db = $this->dbConnect();

        $req2 = $db->query('SELECT * FROM comments');
        return $req2;

    }

} 