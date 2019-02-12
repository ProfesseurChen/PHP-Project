<?php $title = 'Panneau d\'administration'; 

ob_start(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Panneau d'administration</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Les 10 derniers commentaires : </h3>
                <?php 
                while($data = $comment->fetch()) {

                    echo '<p>'.htmlspecialchars($data['pseudo']).' : '.htmlspecialchars($data['comment']).'</p>';
                    echo '<p>Voir l\'article commenté : <a href="index.php?action=fullPost&amp;id=' . $data['id_post'] . '">ICI</a></p><br />';

                }
                ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Les commentaires signalés : </h3><br />
            <?php 

            if (!empty($reported)) {

                
                while ($sign = $reported->fetch()) {

                    echo $sign['id_post'];
                    echo '<p>'.htmlspecialchars($sign['pseudo']).' : '.htmlspecialchars($sign['comment']).'</p>';
                    echo '<p>Modérer le commentaire : <a href="index.php?action=deleteCom&amp;id='.$sign['id_post'].'">Supprimer</a></p><br />';
                } 
            }  else {
                echo '<p>Aucun commentaire signalé !</p>';
            }         
                
            
            ?>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>