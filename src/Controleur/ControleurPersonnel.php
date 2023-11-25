<?php

namespace App\Controleur;

use App\ClassTest;
use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Secretariat;
use App\Modele\HTTP\Session;
use App\Modele\Repository\MaitreStageRepository;
use App\Modele\Repository\SecretariatRepository;
use App\Modele\Repository\TuteurStageRepository;

class ControleurPersonnel extends ControleurGenerique
{

    public static function verifierTuteurExistant() {
        if (isset($_POST['idTuteur'])) {
            $tuteur = (new TuteurStageRepository())->recupererParClePrimaire($_POST['idTuteur']);

            // Retourner l'étudiant en format JSON
            header('Content-Type: application/json');
            echo json_encode(['tuteur' => $tuteur]);
        } else {
            // Retourner null en format JSON
            header('Content-Type: application/json');
            echo json_encode(['tuteur' => null]);
        }
    }


    public static function verifierMaitreStageExistant() {
        if (isset($_POST['numMaitreStage'])) {
            $maitreStage = (new MaitreStageRepository())->recupererParClePrimaire($_POST['numMaitreStage']);
            // Retourner l'étudiant en format JSON
            header('Content-Type: application/json');
            echo json_encode(['maitreStage' => $maitreStage]);
        } else {
            // Retourner null en format JSON
            header('Content-Type: application/json');
            echo json_encode(['maitreStage' => null]);
        }
    }



    public static function afficherSecretaire()
    {
        if(ConnexionUtilisateur::estMaitreSA()){
            self::afficherVue("Personnel/InscriptionSecretariat.html");
        }
    }

    public static function creerSecretaire(): void
    {
        if(ConnexionUtilisateur::estMaitreSA()){
            $secretaire = Secretariat::construireDepuisFormulaire($_POST);
            SecretariatRepository::sauvegarder($secretaire);
            echo '<div class="msgConfirmation"><p> Le Personnel de l\IUT a bien été enregistrée </p></div>';
            self::afficherGestionPersonnel();
        }
    }

    public static function afficherGestionPersonnel()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            if (!Session::getInstance()->contient("requeteFiltrePersonnel")) {
                $personnel = (new SecretariatRepository())->recuperer();
            } else {
                $personnel = (new SecretariatRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltrePersonnel"));
            }
            $tableauParPage = null;
            if ($personnel == null) {
                $nbrePages = 1;
                $page = 1;
            } else {

                //Pagination
                $nombresPersonnel = count($personnel);
                $nbrePages = ceil($nombresPersonnel / 9);

                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page > $nbrePages) {
                        $page = $nbrePages;
                    } else if ($page <= 1) {
                        $page = 1;
                    }
                }
                $y = $page * 9;
                if ($page * 9 > $nombresPersonnel) {
                    $y = $nombresPersonnel;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $personnel[$i];
                }

            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Personnel/vueGestionPersonnel.php", "personnels" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestions du Personnel"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailPersonnel()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "Personnel/vueDetailPersonnel.php", "title" => "Detail Personnel"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherMAJPersonnel()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["login"] || ConnexionUtilisateur::estMaitreSA()) {
            $personnel = (new SecretariatRepository())->recupererParClePrimaire($_GET["login"]);
            if ($personnel != null) {
                self::afficherVue("Personnel/vueMiseAJourPersonnel.php", ["personnel" => $personnel]);
            } else {
                self::afficherErreur("Le personnel de l'iut n'est pas enregistrée");
            }

        } else {
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJPersonnel()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["login"] || ConnexionUtilisateur::estMaitreSA()) {
            if (isset($_POST["login"])) {
                $secretaireAVerifier = (new SecretariatRepository())->recupererParClePrimaire($_POST["login"]);
                if (ConnexionUtilisateur::estMaitreSA() || $secretaireAVerifier->getPremiereConnexion() == 0) {
                    if($secretaireAVerifier->getPremiereConnexion() == 0){
                        if ($_POST['mdp'] != $_POST['mdp2']) {
                            echo '<div class="msgConfirmation"><p> ⚠️ Vos 2 champs de mot de passe ne correspondent pas ⚠️  </p></div>';
                            self::afficherMAJPersonnel();
                        } else {
                            $mdpHache = MotDePasse::hacher($_POST['mdp']);
                            $secretaire = new Secretariat($_POST["login"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"],$_POST["role"],$mdpHache,1);
                            (new SecretariatRepository())->mettreAJour($secretaire);
                            echo '<div class="msgConfirmation"><p> Votre compte a bien été mis à jour </p></div>';
                            self::afficherAccueil();
                        }
                    }else{
                        $secretaire = new Secretariat($_POST["login"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"],$_POST["role"],$secretaireAVerifier->getMdp(),1);
                        (new SecretariatRepository())->mettreAJour($secretaire);
                        self::afficherErreur("Les informations du personnel " . $secretaire->getLogin() . " ont bien été mis à jour");
                    }
                } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["login"]) {
                    if (isset($_POST["mdp"])) {
                        $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $secretaireAVerifier->getMdp());
                        if (!$mdpCorrect) {
                            self::afficherErreur("Mot de passe Incorrect");
                        } else {
                            $secretaire = new Secretariat($_POST["login"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"],$_POST["role"], $secretaireAVerifier->getMdp(),1);
                            (new SecretariatRepository())->mettreAJour($secretaire);
                            self::afficherErreur("Vos informations " . $secretaire->getLogin() . " ont bien été mis à jour");
                        }
                    } else {
                        self::afficherErreur("Veuillez rentrer votre mot de passe");
                    }

                } else {
                    self::afficherErreur("Vous n'avez pas les droits");
                }
            }
        }else{
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function rechercherPersonnel()
    {
        $values = null;
        if (isset($_POST["login"]) && $_POST["login"] != "") {
            $values['login'] = $_POST["login"];
        }
        if (isset($_POST["nomSecretariat"]) && $_POST["nomSecretariat"] != "") {
            $values['nomSecretariat'] = $_POST["nomSecretariat"];
        }
        if (isset($_POST["prenomSecretariat"]) && $_POST["prenomSecretariat"] != "") {
            $values['prenomSecretariat'] = $_POST["prenomSecretariat"];
        }
        if (isset($_POST['adresseMail']) && $_POST["adresseMail"] != "") {
            $values['adresseMail'] = $_POST['adresseMail'];
        }
        if (isset($_POST['telephone']) && $_POST["telephone"] != "") {
            $values['telephone'] = $_POST['telephone'];
        }
        if (isset($_POST['dateDeNaissance']) && $_POST["dateDeNaissance"] != "") {
            $values['dateDeNaissance'] = $_POST['dateDeNaissance'];
        }
        if (isset($_POST['role']) && $_POST["role"] != "") {
            $values['role'] = $_POST['role'];
        }

        Session::getInstance()->enregistrer("requeteFiltrePersonnel", $values);
        self::afficherGestionPersonnel();
    }

    public static function supprimerFiltrePersonnel()
    {
        Session::getInstance()->supprimer("requeteFiltrePersonnel");
        self::afficherGestionPersonnel();
    }



}