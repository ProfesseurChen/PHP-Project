<?php

$title = 'Edition d\'un article';

ob_start(); ?>

<div class="container-fluid">
    <div id="write-block" class="row">
      <div id="write-tinymce" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Modifiez votre article :</h2>
        <?php echo '<form action="index.php?action=updatePost&amp;id=' . $_GET['id'] . '" method="post" enctype="multipart/form-data">'; ?>
              <textarea name="elem1" rows="25"> <?php echo $post['post']; ?> </textarea>
              <input type="submit" name="submitupdate" class="btn btn-primary" value="Envoyer" />
        </form>
      </div>
    </div>
</div>

<?php $home = ob_get_clean(); 

require('template.php'); ?>

?>