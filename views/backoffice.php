<?php $title = 'Panneau d\'administration'; 

ob_start(); ?>

<div class="container-fluid">
<h2>Panneau d'administration</h2>
    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Mon tableau de bord</h3>
            <?php $countpost = $nbpost->rowCount();
            $loginpost = $statslogin->rowCount();
            $nbcomment = $commentspost->rowCount();?>
            <p>Vous avez actuellement écrit : <?php echo $countpost ?> articles.</p>
            <p>Il y a <?php echo $loginpost ?> membres inscris !</p>
            <a href="index.php?action=listMembers">Liste des inscrits</a><br />
            <p><?php echo $nbcomment?> commentaires ont été écris à ce jour.</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Les 10 derniers commentaires : </h3>
            <?php 

            $commentrow = $comment->rowCount();

            if ($commentrow == 0) {

                echo '<p>Pas de commentaires :( </p>';
            } else {

                while($data = $comment->fetch()) {

                    echo '<p>'.htmlspecialchars($data['pseudo']).' : '.htmlspecialchars($data['comment']).'</p>';
                    echo '<p>Voir l\'article commenté : <a href="index.php?action=fullPost&amp;id=' . $data['id_post'] . '">ICI</a></p><br />';

                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Les commentaires signalés : </h3><br />
            <?php 

            $reportedrow = $reported->rowCount();

            if ($reportedrow == 0) {

                echo '<p>Aucun commentaire signalé !</p>';
                
            } else {
                
                while ($sign = $reported->fetch()) {

                    echo '<p>'.htmlspecialchars($sign['pseudo']).' : '.htmlspecialchars($sign['comment']).'</p>';
                    echo '<p>Modérer le commentaire : <a href="index.php?action=deleteCom&amp;id='.$sign['id'].'">Supprimer</a> / <a href="index.php?action=safeComment&amp;id='.$sign['id'].'">C\'est ok !</a></p><br />';
                }
            }

            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Vos messages privés : </h3>
            <?php

            $contactrow = $contact->rowCount();

            if ($contactrow == 0) {

                echo '<p>Il n\'y a aucun message !</p>';

            } else {
        
                while ($view = $contact->fetch()) {

                    echo '<p>Nouveau message de : '.htmlspecialchars($view['pseudo']).'</p>';
                    echo '<p>Email de contact : '.htmlspecialchars($view['mail']).'</p>';
                    echo '<p>Son message : '.htmlspecialchars($view['message']).'</p>';
                    echo '<a href="index.php?action=deleteContactMessage&amp;id='.$view['id'].'"><strong>Supprimer le message</strong></a><br />';
                }
            }
            ?>
        </div>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>