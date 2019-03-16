<?php $title = 'La liste de mes articles'; ?>

<?php ob_start(); ?>

<div id="post-list" class="container-fluid">
    <h1>Tous mes épisodes. N'hésitez pas à laisser vos commentaires ! </h1>
    <div id="list-post" class="row">
        
        

        
        <?php

        $postPerPage = 4;
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

        if ($postrow == 0) { ?>

            <p>Il n'y a aucun billet ! Ils sont en cours de rédaction !</p>

            <?php
        } else {

            while ($home = $post->fetch()) {
                ?>
                <div id="preview_postview" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php $preview = substr($home['post'], 0, 300); ?>
                    <p><?php echo $preview ?> . . . </p><br />
                    <div id="date-postview"><p>Publié le: <?php echo $home['date_post'] ?></p></div>
                    <a href="index.php?action=fullPost&amp;id=<?= $home['id'] ?>"><button type="button" class="btn btn-primary">Lisez la suite !</button></a><br />
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
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); 