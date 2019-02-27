<?php $title = 'Notification';

ob_start(); ?>

<div class="container-fluid">
    <div class="row">
        <div id ="error-pic" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <img src="public/pics/analyze.png" class="img-fluid" alt="Responsive image" />
        </div>
    </div>
    <div class="row">
        <div id="error-message" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2><?php echo $errorMessage; ?></h2>
        </div>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>