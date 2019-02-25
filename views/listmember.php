<?php $title = 'Panneau d\'administration'; 

ob_start(); ?>

<div class="container-fluid">
    <div class="row">
        <h3>Liste des inscris</h3>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            while($listmember = $list->fetch()) {
                echo '<p>'.$listmember['pseudo'].'</p><br />';
            }
            ?>
        </div>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>