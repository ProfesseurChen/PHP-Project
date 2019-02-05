<?php $title = 'Créez votre compte' ?>

<?php ob_start(); ?>

<!-- penser à vérifier si la personne est déjà connecté et si oui, le renvoyer à l'accueil, si non il peut continuer */ -->



<div class="row">
    <div id="title-login-form" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h2>Vous voulez échanger, contribuer ? </h2>
<p>Renseignez les champs ci-dessous et connectez-vous :) : </p><br />
    </div>
</div>


<div id="login-form-block" class="row">
    <div id="login-form" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="views/checkpassword.php" method="post" enctype="multipart/form-data">
            <p><strong>Choississez un pseudo ( 12 caractères maximum ) : </strong></p><br />
            <input type="pseudo" name="my-pseudo" class="form-control" id="inputPseudo" style="width: 200px;" placeholder="Votre pseudo"><br />
            <p><strong>Entrez votre adresse mail: </strong></p><br />
            <input type="mail" name="my-mail" class="form-control" id="inputMail" style="width: 200px;" placeholder="Votre email"><br />
            <p><strong>Entrez un mot de passe ( 16 caractères maximum ) : </strong></p><br />
            <input name="my-password" type="password" class="form-control" id="inputPassword" style="width: 200px;" placeholder="Votre mot de passe"><br />
            <p><strong>Confirmez votre mot de passe : </strong></p><br />
            <input name="my-password2" type="password" class="form-control" id="inputPassword" style="width: 200px;"><br />
            <input id="input-login" type="submit" class="btn btn-primary" value="Créer votre compte" />
        </form>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>

