<!-- Ceci sera le template à utiliser -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../public/pics.favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="public/js/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script>tinymce.init({mode:"exact", language:'fr_FR', elements:'elem1'});</script>
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
            <li> <a href="index.php?action=backoffice">Administration</a> </li>
            <li> <a href="#anchor">Contact</a></li>
          </ul>
            
        </div>
      </nav>
    </div>
    
    <?= $home ?>

    <div id="footer" class="row">
      <div id ="about-me" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h3>À propos de moi : </h3><br />
        <p>Qui cum venisset ob haec festinatis itineribus Antiochiam, praestrictis palatii ianuis, contempto Caesare, quem videri decuerat, ad praetorium cum pompa sollemni perrexit morbosque diu causatus nec regiam introiit nec processit in publicum, sed abditus multa in eius moliebatur exitium addens quaedam relationibus supervacua, quas subinde dimittebat ad principem.</p><br />
      </div>  
      <div id="form-contact" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <p>Une demande ? une suggestion ? c'est par ici ! :) </p><br />            
        <form action="index.php?action=contactForm" method="post" id="anchor" enctype="multipart/form-data">
          <input type="name" name="contact-name" class="form-control" id="inputName" placeholder="Votre Nom" style="width: 200px;" maxlengnth="20"><br />
          <input type="mail" name="contact-mail" class="form-control" id="inputMail" placeholder="Votre email" style="width: 200px;" maxlenght="50"><br />
          <textarea name="contact-message" class="form-control" maxlength="400" rows="5" style="width:300px;" class="mceNoEditor" placeholder="Votre message"></textarea><br />
          <button type="submit" name="submit" class="btn btn-primary">Envoyer !</button><br />
          <p>Limité à 400 caractères</p>
        </form>          
      </div>         
    </div>
  </body>
</html>