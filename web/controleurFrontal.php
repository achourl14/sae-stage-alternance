<?php
require_once( __DIR__ .'/../src/Lib/Psr4AutoloaderClass.php');
use App\Controleur\Controleur;
use App\Lib\MotDePasse;

// initialisation
$loader = new App\Lib\Psr4AutoloaderClass();
$loader->register();
// enregistrement d'une association "espace de nom" → "dossier"
$loader->addNamespace('App', __DIR__ . '/../src');

// On recupère l'action passée dans l'URL
if(isset($_GET['action'])){
    $action = $_GET['action'];
    Controleur::$action();
}else{
    Controleur::afficherAccueil();
}
?>
