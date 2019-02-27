<?php $title = 'Panneau d\'administration'; 

ob_start(); ?>

<div id="backoffice" class="container-fluid">
<h2>Panneau d'administration</h2>
    <div id="stats-admin" class="row">
        
        <div id="stats" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Mon tableau de bord</h3>
            <?php $countpost = $nbpost->rowCount();
            $loginpost = $statslogin->rowCount();
            $nbcomment = $commentspost->rowCount();?>
            <p>Vous avez actuellement écrit : <?php echo $countpost ?> articles.</p>
            <p>Il y a <?php echo $loginpost ?> membres inscrits !</p>
            <p><?php echo $nbcomment?> commentaires ont été écrits à ce jour.</p>
        </div>
    </div>
    <div id="last-comments" class="row">
        <div id="last-comments-block" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
            <h3>Les 5 derniers commentaires : </h3>
            <?php 

            $commentrow = $comment->rowCount();

            if ($commentrow == 0) { ?>

                <div id="no-content">
                    <p>Pas de commentaires :( </p>
                    <img src="public/pics/edit.png" class="img-fluid" alt="Responsive image" />
                </div>
            </div>
            <?php
            } else {

                while ($data = $comment->fetch()) { ?>

                    <div id="block-pseudo-comment-admin">
                    <div id="line-comment"><p><?= htmlspecialchars($data['pseudo']) ?> : <?= htmlspecialchars($data['comment'])?></p></div>
                    <span class="signet-foot-admin"></span>
                    <div id="line-admin"><p>Voir l'article commenté : <a href="index.php?action=fullPost&amp;id=<?= $data['id_post'] ?>">ICI</a></p></div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div id="interact-admin" class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Les commentaires signalés : </h3><br />
            <?php 

            $reportedrow = $reported->rowCount();

            if ($reportedrow == 0) { ?>
                <div id="no-content">
                    <p>Aucun commentaire signalé !</p>
                    <img src="public/pics/siren.png" class="img-fluid" alt="Responsive image" />
                </div>

                <?php
                
            } else {
                
                while ($sign = $reported->fetch()) { ?>

                    <div id="block-pseudo-comment">
                    <div id="line-comment"><p style="font-size:110%"><?= htmlspecialchars($sign['pseudo']) ?> : <?= htmlspecialchars($sign['comment']) ?></p></div>
                    <span class="signet-foot-admin"></span>
                    <div id="line-admin"><p>Modérer le commentaire : <a href="index.php?action=deleteCom&amp;id=<?= $sign['id'] ?>">Supprimer</a> / <a href="index.php?action=safeComment&amp;id=<?= $sign['id'] ?>">C'est ok !</a></p></div>
                    </div>
                    <?php
                }
            }

            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>Vos messages privés : </h3><br />
            <?php

            $contactrow = $contact->rowCount();

            if ($contactrow == 0) { ?>

                <div id="no-content">
                <p>Il n'y a aucun message !</p>
                <img src="public/pics/question.png" class="img-fluid" alt="Responsive image" />
                </div>

                <?php
            } else {
        
                while ($view = $contact->fetch()) { ?>

                    <div id="block-pseudo-comment">
                    <div id="line-comment"><p>Nouveau message de : <?= htmlspecialchars($view['pseudo']) ?></p>
                    <p>Email de contact : <?= htmlspecialchars($view['mail']) ?></p>
                    <p>Son message : <?= htmlspecialchars($view['message']) ?></p></div>
                    <span class="signet-foot-admin"></span>
                    <div id="line-admin"><a href="index.php?action=deleteContactMessage&amp;id=<?= $view['id'] ?>"><strong>Supprimer le message</strong></a></div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>