<!-- Ceci sera la page d'accueil par défaut ! -->
<?php
if (!empty($_SESSION['pseudo'])) {
    $title = 'Bienvenue ' . htmlspecialchars($_SESSION['pseudo']) . ' sur le blog de Jean Forteroche !';
} else {
    $title = 'Bienvenue sur le blog de Jean Forteroche !'; 
}
?> 

<?php ob_start(); ?>

<div class="container-fluid">

    <div class="row">

        <div id="summary" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="summary-content">
            <h2>" Billet simple pour l'Alaska "</h2>
            <p>Bienvenue sur mon blog personnel ! </p><br />
            </div>
        </div>

    </div>
    <div  id="details" class="row">
        <div id="about-blog" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h2>Jusqu'où nous pouvons aller ?</h2>
            <p>" La grande porte s’ouvrit lourdement en coulissant sur le côté gauche sans faire le moindre bruit. Derrière la porte, une nouvelle route, éclairée par de multiples projecteurs accrochés de chaque côtés, s’enfonçait dans les profondeurs de cet ouvrage. Cette route était faite de zigzag incessant, et le froid pesant. Mais le chemin est loin d'être terminé "</p><br />
            <p>" Billet simple pour l'Alaska " est le nouveau roman de Jean Forteroche, auteur de nombreux récits acclamés. Il se sera publié ici même sous forme d'épisodes !</p><br />
        </div>
        
        <?php

        if (empty($_SESSION['pseudo'])) {
        ?>
        <div id="login-block" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div id="login-asset">
            <h4>Vous avez un compte ?</h4><br />
            <p><strong>Connectez-vous !</strong></p>
            <form action="index.php?action=login" method="post" enctype="multipart/form-data">
                <input type="pseudo" name="log-pseudo" class="form-control" id="inputPseudo" placeholder="Votre pseudo"><br />
                <input type="password" name="log-pass" class="form-control" id="inputPassword" placeholder="Votre mot de passe"><br />
                <button type="submit" name="submit" class="btn btn-primary">Se connecter</button><br />
                <p>Vous n'avez pas de compte ?<a href="index.php?action=createLogin"> Cliquez ICI !</a></p>
            </form>
        </div>
    </div>  
        <?php
        } else { ?>
        
            <div id="login-block" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div id="login-asset">
                    <p style="font-weight: bold">Bienvenue <?php echo htmlspecialchars($_SESSION['pseudo']); ?> !</p>
                    <p>Vous pouvez cliquer ici pour vous déconnecter </p>
                    <a href="views/disconnect.php"><button type="button" class="btn btn-primary">Se déconnecter</button></a>
                </div>
            </div>           
        <?php
            } ?>
    </div>
    <div id="preview-title" class="row">
        <div id="preview-child" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h2>Retrouvez tous les épisodes !</h2><br />
            <p>Vous pouvez les trouver dans la section "Épisodes" dans la barre de menu.</p>
            <p> N'hésitez pas à y jeter un oeil, et faire vos retours dans les commentaires !</p>
        </div>

       <?php while ($home = $posts->fetch()) 
      {
        ?>
        <div id ="preview_post" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h3>Le dernier épisode !</h3><br />
        <?php $preview = substr($home['post'], 0, 250); ?>
        <p>Publié le: <?php echo $home['date_post']; ?></p>
        <?php echo $preview . ' . . . <br /><a href="index.php?action=fullPost&amp;id=' . $home['id'] . '"><br />Lire la suite !</a><br />' ?> 
        </div>

      <?php
      }?>
    </div>
</div>

<?php $home = ob_get_clean();

require('template.php'); ?>