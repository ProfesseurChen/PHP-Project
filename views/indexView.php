<!-- Ceci sera la page d'accueil par défaut ! -->
<?php
if (!empty($_SESSION['pseudo'])) {
    $title = 'Bienvenue ' . $_SESSION['pseudo'] . ' sur le blog de Jean Forteroche !';
} else {
    $title = 'Bienvenue sur le blog de Jean Forteroche !'; 
}
?> 

<?php ob_start(); ?>

<div class="container-fluid">

        <div class="row">

            <div id="summary" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="summary-content">
                <h2>Bienvenue sur mon blog personnel !</h2>
                <p>Metuentes igitur idem latrones Lycaoniam !</p><br />
                </div>
            </div>

        </div>
        <div  id="details" class="row">
            <div id="about-blog" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2>Que trouverez vous ici ?</h2>
                <p>Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.</p><br />
                <p>Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus, Luscus quidam curator urbis subito visus: eosque ut heiulans baiolorum praecentor ad expediendum quod orsi sunt incitans vocibus crebris. qui haut longe postea ideo vivus exustus est.</p><br />
            </div>
            
            <?php

            try {
                $db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
                }
            catch(Exception $e) 
                {
                die('Erreur : '.$e->getMessage());
            }

            if (empty($_SESSION['pseudo'])) {
            ?>
            <div id="login-block" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div id="login-asset">
                <h4>Vous avez un compte ?</h4><br />
                <p><strong>Connectez-vous !</strong></p>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="pseudo" name="log-pseudo" class="form-control" id="inputPseudo" placeholder="Votre pseudo"><br />
                    <input type="password" name="log-pass" class="form-control" id="inputPassword" placeholder="Votre mot de passe"><br />
                    <button type="submit" name="submit" class="btn btn-primary">Se connecter</button><br />
                    <p>Vous n'avez pas de compte ?<a href="index.php?action=createLogin"> Cliquez ICI !</a></p>
                </form>
            </div>
        </div>

                <?php if (isset($_POST['submit'])) {

                    $req = $db->prepare('SELECT pseudo, password FROM account');
                    $req->execute(array('login'));
                    $verif = $req->fetch();

                    if (empty($_POST['log-pseudo'])) {

                            echo '<p>Vous n\'avez pas renseigné de pseudo</p>';
                        }
                        elseif (empty($_POST['log-pass'])) {

                            echo '<p>Vous n\'avez pas renseigné de mot de passe </p>';

                        } elseif ($_POST['log-pseudo'] != $verif['pseudo']) {

                            echo '<p>Votre pseudo n\'existe pas ! Inscrivez-vous !</p>';

                        } elseif (($_POST['log-pseudo'] == $verif['pseudo']) && (!password_verify($_POST['log-pass'], $verif['password']))){
                                echo 'Votre mot de passe ne correspond pas !';
    
                            } else {

                                $_SESSION['pseudo'] = $_POST['log-pseudo'];
                            }    
                        } ?>

<?php
            } else { ?>
            
                <div id="login-block" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div id="login-asset">
                        <p>Bienvenue <?php echo htmlspecialchars($_SESSION['pseudo']); ?> ! </p>
                        <p>Vous pouvez cliquer ici pour vous déconnecter: <a href="views/disconnect.php">ICI</a></p>
                    </div>
                </div>           
<?php
    } ?>

    </div>
    <div id="preview-title" class="row">
        <div id="preview-child" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2>Un aperçu de mes articles !</h2>
            <p>Vous pouvez en trouvez d'autres dans la sections "Mes articles" dans la barre de menu.</p><br />
            <p> N'hésitez pas à y jeter un oeil, et faire vos retours dans les commentaires !</p>
        </div>
    </div>
    <div id="block-preview" class="row">
       <?php while ($home = $posts->fetch()) 
      {
        ?>
        <div id ="preview_post" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <?php $preview = substr($home['post'], 0, 250);
        echo $preview . ' . . . <br /><a href="index.php?action=fullPost&amp;id=' . $home['id'] . '"><br />Lire la suite !</a><br />' ?> </div>

      <?php
      }?>
    </div>
</div>

<?php $home = ob_get_clean();

require('template.php'); ?>