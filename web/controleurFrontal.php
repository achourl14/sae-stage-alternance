<?php
require_once( __DIR__ .'/../src/Lib/Psr4AutoloaderClass.php');
use App\Controleur\Controleur;
use App\Controleur\ControleurGenerique;
use App\Lib\MotDePasse;

// initialisation
$loader = new App\Lib\Psr4AutoloaderClass();
$loader->register();
// enregistrement d'une association "espace de nom" → "dossier"
$loader->addNamespace('App', __DIR__ . '/../src');

// On recupère l'action passée dans l'URL
//if(isset($_GET['Controleur']))
//if(isset($_GET['action'])){
//    $action = $_GET['action'];
//    Controleur::$action();
//}else{
//    \App\Controleur\ControleurGenerique::afficherAccueil();
//}
$nomDeClasseControleur = "App\Controleur\Controleur";
if(isset($_GET['controleur'])) {
    $controleur = $_GET['controleur'];
    $nomDeClasseControleur .= ucfirst($controleur);
    if (class_exists($nomDeClasseControleur)) {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $methods = get_class_methods($nomDeClasseControleur);
            if (in_array($action, $methods)) {
                $nomDeClasseControleur::$action();
            } else {
                $nomDeClasseControleur::afficherErreur("Méthod not founded (Méthode non trouvé)");
            }
        } else {
            ControleurGenerique::afficherAccueil();
        }
    } else {
        \App\Controleur\ControleurGenerique::afficherErreur("Aucun Controleur de ce nom ci trouvé");
    }
}else{
    \App\Controleur\ControleurGenerique::afficherAccueil();
}
?>
