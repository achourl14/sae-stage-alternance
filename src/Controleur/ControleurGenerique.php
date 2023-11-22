<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\HTTP\Session;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\SecretariatRepository;

class ControleurGenerique
{
    protected static function afficherVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require("../src/Vue/$cheminVue"); // Charge la vue
    }

    public static function afficherErreur($message, $vue = null)
    {
        echo '<div class="msgConfirmation"><p>' . $message . '</p></div>';
        if ($vue != null) {
            self::$vue();
        } else {
            self::afficherAccueil();
        }
    }

    public static function connecter()
    {
        $cle = "";

        if (!isset($_POST['login']) || !isset($_POST['mdp'])) {
            echo '<div class="msgConfirmation"><p>Veuillez rentrer l\'ensemble des champs</p></div>';
        }

        if ($_POST['type_connexion'] == 'secretariat') {
            $utilisateurAVerifier = (new SecretariatRepository())->recupererParClePrimaire($_POST['login']);
            $cle = "secretariat";
        } else if ($_POST['type_connexion'] == 'etudiant') {
            $utilisateurAVerifier = (new EtudiantRepository())->recupererParClePrimaire($_POST['login']);
            $cle = "etudiant";
        } else if ($_POST['type_connexion'] == 'entreprise') {
            $utilisateurAVerifier = (new EntrepriseRepository())->recupererParClePrimaire($_POST['login']);
            $cle = "entreprise";
        } else {
            echo '<div class="msgConfirmation"><p>Erreur au niveau type de connexion</p></div>';
        }

        if ($utilisateurAVerifier == null) {
            echo '<div class="msgConfirmation"><p>Aucun compte de ce login existe</p></div>';
        } else {
            $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $utilisateurAVerifier->getMdp());
            if (!$mdpCorrect) {
                echo '<div class="msgConfirmation"><p>Mot de passe incorrect</p></div>';
            } else {
                ConnexionUtilisateur::connecter($utilisateurAVerifier->getLogin());
                $session = Session::getInstance();
                $session->enregistrer($cle, 1);
            }
        }


        self::afficherAccueil();
    }

    public static function afficherAccueil()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "Generale/index.html", "title" => "Accueil"]);
    }

    public static function afficherInscription()
    {
        self::afficherVue("Entreprise/inscription.html");
    }
    public static function afficherConnexion()
    {
        self::afficherVue("Generale/connexion.html");
    }
}