<?php
require_once( __DIR__ .'/../src/Lib/Psr4AutoloaderClass.php');
use App\Controleur\Controleur;

// initialisation
$loader = new App\Lib\Psr4AutoloaderClass();
$loader->register();
// enregistrement d'une association "espace de nom" → "dossier"
$loader->addNamespace('App', __DIR__ . '/../src');

// On recupère l'action passée dans l'URL
$action = $_GET['action'];

// Appel de la méthode statique $action de ControleurVoiture
Controleur::$action();

?>
