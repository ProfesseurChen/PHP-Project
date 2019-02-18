<?php $title = 'Un article !'; ?>
        
<?php ob_start(); ?>
<div class="container-fluid">
	<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == '1') { ?>
	<div id="admin-button-block" class="row">
		<div id="admin-button" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<?php echo '<button type="button" class="btn btn-primary"><a href="index.php?action=editPost&amp;id=' . $post['id'] . '">Éditer</a></button>'; ?><br />
		<?php echo '<button type="button" class="btn btn-danger"><a href="index.php?action=deletePost&amp;id=' . $post['id'] . '">Supprimer</a></button>'; ?><br />
		</form>
		
		</div>
	</div> <?php } else { 
		
	 } ?>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php if (isset($confirmUpdate)) {

				echo $confirmUpdate;

			} else {
				echo '';
			} ?>
		</div>
	</div>
	<div class="row">
		<div id="post-view" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

             <?php echo $post['post']; ?>
			
		</div>			
	</div>
	<div id="interaction" class="row">
		<div id="block-reaction" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<div id="block1">
			<h3>Laissez votre commentaire :</h3><br />
			<p><strong>Connectez-vous et réagissez ! Votre avis nous intéresse ! </strong></p>

			
			<?php
			if (isset($_SESSION['pseudo'])) {
				echo '<form action="index.php?action=writeComments&amp;id='.$_GET['id'].'" method="post" enctype="multipart/form-data">'; ?>
				<p>Votre pseudo : <?php echo $_SESSION['pseudo']; ?></p>
				<?php echo '<input type="hidden" name="name-comment" value="'.$_SESSION['pseudo'].'" />'; ?>
				<textarea name="comment" class="form-control" rows="5" style="width:300px;" class="mceNoEditor"> </textarea><br />
				<input type="submit" class="btn btn-primary" value="Envoyer" />
				</form> 
			<?php } else { ?>
				
				<p>Vous devez être inscrit et vous connecter pour pouvoir poster un message ! Ça se passe : <a href="index.php">ICI</a></p>

			<?php } ?>
			</div>
		</div>

		<div id="block-comment" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div id="bloc2">
			<h3>Vos réactions :</h3><br />

			
			<?php

			$commentrow = $comment->rowCount();

			if ($commentrow == 0) {

				echo '<p>Il n\'y a pas encore de commentaire !</p>';
			} else {

				while ($date = $comment->fetch())  {
				
				echo '<div id="block-pseudo-comment">';
				echo '<div id="pseudo-comment"><p>'.htmlspecialchars($date['pseudo']).'</p></div>';
				echo '<span class="signet"></span>';
				echo '<div id="comment-post-line">'.htmlspecialchars($date['comment']).' </div>';
					if (isset($_SESSION['pseudo'])) {

						echo '<span class="signet"></span>';
						echo '<p><a href="index.php?action=reportComment&amp;id='.$date['id'].'" >Signaler</a></p>';
						echo '</div>';
					} else {
						echo '</div>';
					}
				}
			}
			?>
			</div>

		</div>
	</div>
</div>
<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>