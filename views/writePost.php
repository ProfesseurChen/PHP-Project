<?php $title = 'Un article !'; ?>

<?php ob_start(); ?>

<div class="container-fluid">
    <div id="write-block" class="row">
      <div id="write-tinymce" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Écrivez votre billet :</h2>
        <form action="index.php?action=addPost" method="post">
              <textarea name="elem1" rows="10"> </textarea>
              <input type="submit" class="btn btn-primary" value="Envoyer" />
        </form>
      </div>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>