<?php $title = 'Un article !'; ?>
        
<?php ob_start(); ?>

	<article>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<?php echo $post['post']; ?>
				
			</div>			
		</div>
	</article>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>
