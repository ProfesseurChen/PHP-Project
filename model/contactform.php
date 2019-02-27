<?php 

require_once('dbmanager.php');

class ContactForm extends Manager {

    public function addMessage($pseudo, $mail, $message) {

        $db = $this->dbConnect();

        $add = $db->prepare('INSERT INTO contact(pseudo, mail, message) VALUES(:pseudo, :mail, :message)');
        $add->execute(array(
            'pseudo' => $pseudo,
            'mail' => $mail,
            'message' => $message
        ));
        throw new Exception('Votre message a bien été envoyé à Jean ! Il vous répondra bientôt !');

    }

    public function viewMessage() {

        $db = $this->dbConnect();

        $req = $db->query('SELECT * FROM contact ORDER BY ID DESC');
        return $req;

    }

    public function deleteMessage($postId) {

        $db = $this->dbConnect();

        $req2 = $db->prepare('DELETE FROM contact WHERE id = ?');
        $req2->execute(array($postId));
        
        throw new Exception('Le message a été supprimé !');

    }
}