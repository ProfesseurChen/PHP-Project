<!-- Ceci sera le template à utiliser -->


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../public/pics.favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="public/js/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script>tinymce.init({selector:'textarea', language:'fr_FR'});</script>
  </head>

  <body>
    <div class="container-fluid">

      <header>
          
        <div id="title" class="row">
         <div id="logo">
             <img id="logo-header" src="public/pics/logo.png" alt="logo blog" />
         </div>
        </div>
          
      </header>

      <nav >
        <div id="fixed" class="navbar navbar-inverse">
            
          <ul class="nav navbar-nav">
            <li> <a href="index.php">Accueil</a> </li>
            <li> <a href="index.php?action=postView">Mes articles</a> </li>
            <li> <a href="index.php?action=writePost">Édition</a> </li>
            <li> <a href="#anchor">Contact</a></li>
          </ul>
            
        </div>
      </nav>
    
      <?= $home ?>

      <footer>
        <div id="anchor" class="row">

          <div id ="about-me" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>À propos de moi : </h3><br />
            <p>Qui cum venisset ob haec festinatis itineribus Antiochiam, praestrictis palatii ianuis, contempto Caesare, quem videri decuerat, ad praetorium cum pompa sollemni perrexit morbosque diu causatus nec regiam introiit nec processit in publicum, sed abditus multa in eius moliebatur exitium addens quaedam relationibus supervacua, quas subinde dimittebat ad principem.</p><br />
          </div>
            
        </div>
          
        <div id="about-me-form" class="row">
            
          <div id="form-contact" class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
            <p>Une demande ? une suggestion ? c'est par ici ! :) </p><br />
              
            <form>
                <input type="pseudo" class="form-control" id="inputPseudo" placeholder="Votre Nom" style="width: 200px;"><br />
                <input type="mail" class="form-control" id="inputMail" placeholder="Votre email" style="width: 200px;"><br />
                <input type="text" class="form-control" id="inputText" placeholder="Votre Message" maxlength="400" rows="3"><br />
                <button type="submit" class="btn btn-primary">Envoyer !</button><br/ >
                <p>Limité à 400 caractères</p>
            <!-- Prévoir un captcha pour éviter les spams avant l'envoi -->
            </form>
              
          </div>
            
        </div>
      </footer>
      
    </div>
  </body>
</html>