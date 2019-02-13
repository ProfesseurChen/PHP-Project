<?php $title = 'La liste de mes articles'; ?>

<?php ob_start(); ?>

<article>
    <div id="list-post" class="row">
        
        <h1>La liste de mes articles. N'hésitez pas à laisser vos commentaires en dessous ! </h1>

        
        <?php

        $db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
        $postPerPage = 5; #Je veux 5 articles par page
        $postsRequest = $db->query('SELECT id from tickets'); 
        $posts = $postsRequest->rowCount(); #rowCount me permet de compter le nombre de lignes affectées par la dernière requête

        $pages = ceil($posts/$postPerPage); #ceil me permet d'arrondir au nombre entier supérieur le plus proche

        if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pages) {

            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } 

            else {
            $currentPage = 1;
        }

        $start = ($currentPage-1)*$postPerPage;    
        while ($home = $post->fetch()) {
            ?>
            <div id="preview_post" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php $preview = substr($home['post'], 0, 400);
                echo $preview . ' <br /> . . . <br /> <button type="button" class="btn btn-primary"><a href="index.php?action=fullPost&amp;id=' . $home['id'] . '">Lisez la suite !</a></button><br />' ?>
            </div>

            <?php
          }
          ?>
        <div id="pagination" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="pagination justify-content-center">
                <?php

                for ($i=1;$i<=$pages;$i++) 
                { 
                    if($i == $currentPage) {
                    ?>
                    
                    <li class="page-item disabled"> <?php echo '<a class="page-link" href="index.php?action=postView&amp;page='.$i.'">'.$i.'</a>'; ?></li>

                    <?php
                    } else {
                    ?>
                    <li class="page-item"><?php echo '<a class="page-link" href="index.php?action=postView&amp;page='.$i.'">'.$i.'</a> '; ?></li>
                    <?php
                    }
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</article>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); 