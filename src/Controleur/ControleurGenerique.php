<?php

namespace App\Controleur;

use App\ClassTest;
use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\HTTP\Session;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\OffreRepository;
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
        $utilisateurAVerifier = null;

        if (!isset($_POST['login'])) {
            echo '<div class="msgConfirmation"><p>Veuillez rentrer le champ login</p></div>';
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
            if($_POST['type_connexion'] == 'etudiant' || $_POST['type_connexion'] == 'secretariat'){
                if ($utilisateurAVerifier->getPremiereConnexion() == 0) {
                    echo '<div class="msgConfirmation"><p>Vous devez changer votre mot de passe</p></div>';
                } else {
                    $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $utilisateurAVerifier->getMdp());
                    if (!$mdpCorrect) {
                        echo '<div class="msgConfirmation"><p>Mot de passe incorrect</p></div>';
                        self::afficherConnexion();
                        die();
                    }
                }
            }
            $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $utilisateurAVerifier->getMdp());
            if (!$mdpCorrect) {
                echo '<div class="msgConfirmation"><p>Mot de passe incorrect</p></div>';
                self::afficherConnexion();
                die();
            }
            ConnexionUtilisateur::connecter($utilisateurAVerifier->getLogin());
            $session = Session::getInstance();
            $session->enregistrer($cle, 1);
            if ($_POST['type_connexion'] == 'secretariat' || $_POST['type_connexion'] == 'etudiant') {
                if ($utilisateurAVerifier->getPremiereConnexion() == 0) {
                    if ($_POST['type_connexion'] == 'secretariat') {
                        header("Location: controleurFrontal.php?controleur=personnel&action=afficherMAJPersonnel&login=" . ConnexionUtilisateur::getLoginUtilisateurConnecte());
                        die();
                    } else {
                        header("Location: controleurFrontal.php?controleur=etudiant&action=afficherMAJEtudiant&login=" . ConnexionUtilisateur::getLoginUtilisateurConnecte());
                        die();
                    }
                }
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

    public static function seDeconnecter()
    {
        if (ConnexionUtilisateur::estConnecte()) {
            ConnexionUtilisateur::deconnecter();
            echo '<div class="msgConfirmation"><p>Vous êtes  bien déconnecté</p></div>';
            self::afficherAccueil();
        } else {
            self::afficherErreur("Vous êtes pas connecté");
            self::afficherAccueil();
        }
    }

    public static function estAdmin()
    {
        if (ClassTest::$DEBUG) {
            ConnexionUtilisateur::connecter('admin');
            $cle = 'secretariat';
            $session = Session::getInstance();
            $session->enregistrer($cle, 1);
            $cle = "etudiant";
            $session->enregistrer($cle, 1);
            $cle = "entreprise";
            $session->enregistrer($cle, 1);
            self::afficherAccueil();
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherLDAP()
    {
        self::afficherVue("LDAP.php");
    }

    public static function afficherBord()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "Personnel/vueBord.php", "title" => "TableauDeBord"]);
    }
}