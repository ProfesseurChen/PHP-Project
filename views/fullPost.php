<?php $title = 'Un article !'; ?>
        
<?php ob_start(); ?>
<div class="container-fluid">
	<div class="row">
		<div id="post-view" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<?php echo $post['post']; ?>
			
		</div>			
	</div>
	<div class="row">
		<div id="block-reaction" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<h3>Laissez votre commentaire :</h3><br />
			<p><strong>Connectez-vous et réagissez ! Votre avis nous intéresse ! </strong></p>
			<?php echo '<form action="index.php?action=fullPost&amp;id="'.$_GET['id'].' method="post" enctype="multipart/form-data">'; ?>
			<p>Votre pseudo : </p>
			<input type="pseudo" name="name-comment" class="form-control" id="inputPseudo" placeholder="Votre pseudo" style="width:200px;"/><br />
			<p>Votre commentaire : </p>
			<textarea name="comment" class="form-control" rows="5" style="width:300px;" class="mceNoEditor"> </textarea><br />
			<input type="submit" class="btn btn-primary" value="Envoyer" />
			</form>
		</div>

		<?php 

		$db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		if (isset($_POST['name-comment']) && isset($_POST['comment'])) {

			$insert = $db->prepare('INSERT INTO comments(id_post, comment, date) VALUES(?, ?, ?, NOW()');
			$insert->execute($_GET['id'], $_POST['name-comment'], $_POST['comment']);

			$insert->closeCursor();
		}

		?>
		<div id="block-comment" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h3>Les 5 dernières réactions :</h3><br />
			<?php

			$comment = $db->query('SELECT pseudo, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS comment_timestamp FROM comments WHERE id_post = ? ORDER BY comment_date LIMIT DESC 0, 5');

			if (isset($comment['comment'])) {

				while ($date = $comment->fetch())  {
					echo '<strong><p>'.$data['pseudo'].' ( le '.$data['comment_timestamp'].' ) : </p></strong><br />';
					echo '<p>'.$data['comment'].'</p>';
				}
			} else {
				echo '<p><strong>Il n\'y a aucun commentaire ! </strong></p><br />';
			}
			
			?>

		</div>
	</div>
</div>
<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>
