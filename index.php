<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/materialize.min.css.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
<?php
function chargerClasse($classname)
{
  require "entites/" . $classname.'.php';

}


spl_autoload_register('chargerClasse');
require "modele/connexion_sql.php";
require "modele/PersonnageManager.php";



$manager = new PersonnageManager($bdd);



if (isset($_POST['nom'])) {
$nom = htmlspecialchars($_POST['nom']);
$exist = $manager->existeNom($nom);
if (!$exist) {
  $personnage = new Personnage(['nom' => $nom]);
  $manager->add($personnage);
} else {

  $error = "nom deja utilisé";
}

}

if (isset($_POST['attaque'])) {

  if ($_POST['attaquant'] != $_POST['adversaire'] ){
    $attaquant = $manager->get($_POST['attaquant']);
    $adversaire = $manager->get($_POST['adversaire']);
    $attaquant->attaquer($adversaire);
    $manager->Update($adversaire);
    if ($adversaire->getDegats() >= 100) {
      $manager->Delete($adversaire);
    }

  } else {
    $error = "Tu ne peux pas t'attaquer";
  }

}

if(isset($_POST['reset'])) {
  $persos = $manager->getList();
  foreach ($persos as $perso) {
 $manager->ResetAllDegats($perso);
  }
}

$persos = $manager->getList();

require "vue/index.php";


 ?>





        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
