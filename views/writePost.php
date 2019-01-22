<?php $title = 'Un article !'; ?>

<?php ob_start(); ?>

<div id="write-tinymce">
    <div id="write-block">
      <h2>Écrivez votre billet :</h2>
      <form action="views/write.php" method="post">
            <textarea name="post" rows="15" > </textarea>
            <input type="submit" class="btn btn-primary" value="Envoyer" />
      </form>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>