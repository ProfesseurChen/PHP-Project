<?php $title = 'La liste de mes articles'; ?>

<?php ob_start(); ?>

<article>
    <div id="list-post" class="row">
        
        <h1>La liste de mes articles. Vous pouvez choisir l'article et le commenter ! ;o </h1>
        
        <?php
        
        try 
	    {
  		$db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e) 
        {
        die('Erreur : '.$e->getMessage());
        }
        
        $postPerPage = 5; #Je veux 5 articles par page
        $postsRequest = $db->query('SELECT id from tickets'); 
        $posts = $postsRequest->rowCount(); #rowCount me permet de compter le nombre de lignes affectées par la dernière requête

        $pages = ceil($posts/$postPerPage); #ceil me permet d'arrondir au nombre entier supérieur le plus proche

        if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pages) {

        $_GET['page'] = intval($_GET['page']);
        $currentPage = $_GET['page'];

        } 

        else 

        {
            $currentPage = 1;
        }

        $start = ($currentPage-1)*$postPerPage; #nombre d'articles total maximum disponible

        $articles = $db->query('SELECT * FROM tickets ORDER BY id DESC LIMIT '.$start.','.$postPerPage);
        
        while ($home = $articles->fetch()) 
          {
            ?>
        <div id="preview_post" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php $preview = substr($home['post'], 0, 400);
            echo $preview . ' . . . <br /><a href="index.php?action=fullPost&amp;id=' . $home['id'] . '">Lire la suite !</a>' ?>
        </div>

        <?php
          }

          for ($i=1;$i<=$pages;$i++) 
          { 
            if($i == $currentPage) {

            echo $i.' ';

            } else {

            echo '<a href="index.php?action=postView&amp;page='.$i.'">'.$i.'</a> ';

            }
          }

          ?>
    </div>
</article>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>