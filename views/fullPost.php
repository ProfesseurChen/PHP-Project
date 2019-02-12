<?php $title = 'Un article !'; ?>
        
<?php ob_start(); ?>
<div class="container-fluid">
	<div id="admin-button-block" class="row">
		<div id="admin-button" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php echo '<button type="button" class="btn btn-primary"><a href="index.php?action=editPost&amp;id=' . $post['id'] . '">Éditer</a></button>'; ?><br />
		<?php echo '<button type="button" class="btn btn-danger"><a href="index.php?action=deletePost&amp;id=' . $post['id'] . '">Supprimer</a></button>'; ?><br />
		</form>
		
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php if (isset($confirmUpdate)) {

				echo $confirmUpdate;

			} else {
				echo '';
			}?>
		</div>
	</div>
	<div class="row">
		<div id="post-view" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

             <?php echo $post['post']; ?>
			
		</div>			
	</div>
	<div class="row">
		<div id="block-reaction" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<h3>Laissez votre commentaire :</h3><br />
			<p><strong>Connectez-vous et réagissez ! Votre avis nous intéresse ! </strong></p>
			<?php echo '<form action="index.php?action=writeComments&amp;id='.$_GET['id'].'" method="post" enctype="multipart/form-data">'; ?>
			<p>Votre pseudo : </p>
			<input type="pseudo" name="name-comment" class="form-control" id="inputPseudo" placeholder="Votre pseudo" style="width:200px;"/><br />
			<p>Votre commentaire : </p>
			<textarea name="comment" class="form-control" rows="5" style="width:300px;" class="mceNoEditor"> </textarea><br />
			<input type="submit" class="btn btn-primary" value="Envoyer" />
			</form>
		</div>

		<div id="block-comment" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h3>Les 5 dernières réactions :</h3><br />

			
			<?php
			if (!empty($comment)) {
				while ($date = $comment->fetch())  { ?>
					<div id="comment-box">
					<?php 
					echo '<div id="pseudo-comment"><strong>'.htmlspecialchars($date['pseudo']).'</strong> : '.htmlspecialchars($date['comment']).' </div><br />';
					echo '<p><a href="index.php?action=reportComment&amp;id='.$date['id'].'" >Signaler</a></p>' ?>
					</div><br />
					<?php
					}

				} else {

					echo '<p>Il n\'y a pas encore de commentaire !</p>';
				}
			
			?>

		</div>
	</div>
</div>
<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>
