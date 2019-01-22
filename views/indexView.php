<!-- Ceci sera la page d'accueil par défaut ! -->


<?php $title = 'Bienvenue sur le blog de Jean Forteroche !'; ?>

<?php ob_start(); ?>

<section>
    <div class="row">
      
    <div id="summary" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="summary-content">
      <h2>Bienvenue sur mon blog personnel !</h2>
        <p>Metuentes igitur idem latrones Lycaoniam !</p><br />
        </div>
    </div>
    
        
        
    <div id="about-blog" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Que trouverez vous ici ?</h2>
        <p>Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.</p><br />
        <p>Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus, Luscus quidam curator urbis subito visus: eosque ut heiulans baiolorum praecentor ad expediendum quod orsi sunt incitans vocibus crebris. qui haut longe postea ideo vivus exustus est.</p><br />
    </div>

    <div id="login-block" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="login-asset">
            <p>Vous avez un compte ?</p><br />
            <p><strong>Connectez-vous !</strong></p>
            <form>
              <input type="pseudo" class="form-control" id="inputPseudo" placeholder="Votre pseudo"><br />
              <input type="password" class="form-control" id="inputPassword" placeholder="Votre mot de passe"><br />
              <button type="submit" class="btn btn-primary">Se connecter</button><br />
              <p>Vous n'avez pas de compte ?<a href="#"> Cliquez ICI !</a></p>
            </form>
        </div>
    </div>

    </div>
  </section>
  <article>
    <div id="posts-block" class="row">
        <span id="posts-title"><h2>Mes deux derniers articles !</h2></span>
      <!-- Récupération d'articles -->
      
      <?php

      while ($home = $req->fetch()) 
      {
        ?>
        <div id ="preview_post" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <?php $preview = substr($home['post'], 0, 250);
        echo $preview . ' . . . <a href="index.php?action=fullPost&amp;id=' . $home['id'] . '"><br />Lire la suite !</a>' ?> </div>
      
      <?php
      }

    $req->closeCursor();

    ?>
  </div>
  </article>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>