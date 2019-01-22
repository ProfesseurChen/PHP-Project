<?php $title = 'Créez votre compte' ?>

<?php ob_start(); ?>

<!-- penser à vérifier si la personne est déjà connecté et si oui, le renvoyer à l'accueil, si non il peut continuer */ -->



<div class="row">
    <div id="title-login-form" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h2>Vous voulez échanger, contribuer ? </h2>
<p>Renseignez les champs ci-dessous et connectez-vous :) : </p><br />
    </div>
</div>



<?php 

try {
    $db = new PDO('mysql:host=localhost;dbname=project;charset=utf8', 'root', 'root');
    }
catch(Exception $e) 
    {
    die('Erreur : '.$e->getMessage());
}

if (isset($_POST['submit'])) {
    
    if (!empty($_POST['pseudo']) && !empty($_POST['surname']) && !empty($_POST['name']) && !empty($_POST['password'])) {
        
        if (strlen($_POST['password']) >= 6 && strlen($_POST['pseudo'] <= 12 && strlen($_POST['surname']) <= 20) {
            
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $surname = htmlspecialchars($_POST['surname']);
            $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $req = $db->prepare('INSERT INTO account(pseudo, surname, password) VALUES( :pseudo, :surname, :password)');
            $req->execute(array(
            'pseudo' => $pseudo,
            'surname' => $surname,
            'password' => $pass_hash));
        } else {
            echo '<p>Erreur: veuillez retentez de vous indentifier !</p>';
        }
    
    }
}




/* Je garde dans un coin */


/* echo "<p>Vous n'avez pas rempli tous les champs ! D: </p>";
            
    } elseif ($verif['pseudo_exist'] == '1') {
        
        echo "<p>Ce pseudo existe déjà ! D: </p>";
        
    } elseif (!preg_match("#[a-zA-Z0-9_-]{6,12}#", $_POST['pseudo'])) {
        
        echo "<p>Votre pseudo n'est pas au bon format ! ( Entre 6 et 12 caractères, les - et _ sont autorisés )</p>";
        
    } elseif (!preg_match("#[a-zA-Z]{2,25}#", $_POST['name'])) {
        
        echo "<p>Votre nom n'est pas au bon format !</p>";
            
    } elseif (!preg_match("#[a-zA-Z]{2,25}#", $_POST['surname'])) {
        
        echo "<p>Votre prénom n'est pas au bon format !</p>";
        
    } elseif (!preg_match("#[a-zA-Z0-9]{8,16}#", $_POST['password'])) {
        
        echo "<p>Le mot de passe n'est pas au bon format ! ( Minimum 6 et maximum 16 caractères )</p>";
        
    } else {
        
    }
} */






?>

<div id="login-form-block" class="row">
    <div id="login-form" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form action="index.php?action=createLogin" method="post">
            <p>Choississez un pseudo : </p><br />
            <input type="pseudo" class="form-control" id="inputPseudo" style="width: 200px;" placeholder="Votre pseudo"><br />
            <p>Entrez votre prénom : </p><br />
            <input type="surname" class="form-control" id="inputSurname" style="width: 200px;" placeholder="Votre prénom"><br />
            <p>Entrez un mot de passe : </p><br />
            <input type="password" class="form-control" id="inputPassword" style="width: 200px;" placeholder="Votre pseudo"><br />
            <input id="input-login" type="submit" class="btn btn-primary" value="Créer votre compte" />
        </form>
    </div>
</div>

<?php $home = ob_get_clean(); ?>

<?php require('template.php'); ?>

