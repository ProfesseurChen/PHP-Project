<?php $title = 'La liste de mes articles'; ?>

<?php ob_start(); ?>

<article>
    <div id="list-post" class="row">
        
        <h1>La liste de mes articles. N'hésitez pas à laisser vos commentaires en dessous ! </h1>

        
        <?php

        $postPerPage = 6;
        $pages = ceil($pagination/$postPerPage);

        if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pages) {

            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
    
            } 
    
            else 
    
            {
                $currentPage = 1;
            }

        $start = ($currentPage-1)*$postPerPage;

        $postrow = $post->rowCount();

        if ($postrow == 0) {

            echo'<p>Il n\'y a aucun billet ! Ils sont en cours de rédaction !</p>';
        } else {

            while ($home = $post->fetch()) {
                ?>
                <div id="preview_postview" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php $preview = substr($home['post'], 0, 400);
                    echo $preview . ' <br /> . . . <br /> <button type="button" class="btn btn-primary"><a href="index.php?action=fullPost&amp;id=' . $home['id'] . '">Lisez la suite !</a></button><br />' ?>
                </div>

                <?php
            }
        }
        ?>
        <div id="pagination" class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="pagination justify-content-center">
                <?php

                for ($i=1;$i<=$pages;$i++) 
                { 
                    if ($i == $currentPage) {
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