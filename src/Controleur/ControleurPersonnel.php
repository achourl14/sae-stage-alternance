<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Secretariat;
use App\Modele\HTTP\Session;
use App\Modele\Repository\ConventionStageRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\MaitreStageRepository;
use App\Modele\Repository\SecretariatRepository;
use App\Modele\Repository\TuteurStageRepository;

class ControleurPersonnel extends ControleurGenerique
{

    public static function verifierTuteurExistant()
    {
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


    public static function verifierMaitreStageExistant()
    {
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
        if (ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("Personnel/InscriptionSecretariat.html");
        }
    }

    public static function creerSecretaire(): void
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            $secretaire = Secretariat::construireDepuisFormulaire($_POST);
            SecretariatRepository::sauvegarder($secretaire);
            echo '<div class="msgConfirmation"><p> Le Personnel de l\IUT a bien été enregistrée </p></div>';
            self::afficherGestionPersonnel();
        }
    }

    public static function afficherGestionPersonnel()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            if (!Session::getInstance()->contient("requeteFiltrePersonnel")) { // on regarde si il y'a une recherche
                $personnel = (new SecretariatRepository())->recuperer();
            } else {
                $personnel = (new SecretariatRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltrePersonnel")); // recupération de la requete filtré
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
                    if ($secretaireAVerifier->getPremiereConnexion() == 0) {
                        if ($_POST['mdp'] != $_POST['mdp2']) {
                            echo '<div class="msgConfirmation"><p> ⚠️ Vos 2 champs de mot de passe ne correspondent pas ⚠️  </p></div>';
                            self::afficherMAJPersonnel();
                        } else {
                            $mdpHache = MotDePasse::hacher($_POST['mdp']);
                            if(!ConnexionUtilisateur::estMaitreSA()){
                                $role = 'T';
                            }else{
                                $role = $_POST["role"];
                            }
                            $secretaire = new Secretariat($_POST["login"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"], $role, $mdpHache, 1);
                            (new SecretariatRepository())->mettreAJour($secretaire);
                            echo '<div class="msgConfirmation"><p> Votre compte a bien été mis à jour </p></div>';
                            self::afficherAccueil();
                        }
                    } else {
                        $secretaire = new Secretariat($_POST["login"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"], $_POST["role"], $secretaireAVerifier->getMdp(), 1);
                        (new SecretariatRepository())->mettreAJour($secretaire);
                        self::afficherErreur("Les informations du personnel " . $secretaire->getLogin() . " ont bien été mis à jour");
                    }
                } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["login"]) {
                    if (isset($_POST["mdp"])) {
                        $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $secretaireAVerifier->getMdp());
                        if (!$mdpCorrect) {
                            self::afficherErreur("Mot de passe Incorrect");
                        } else {
                            $secretaire = new Secretariat($_POST["login"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"], $secretaireAVerifier->getRole(), $secretaireAVerifier->getMdp(), 1);
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
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function rechercherPersonnel()
    {
        $values = null;
        if (isset($_POST["login"]) && $_POST["login"] != "") { // on regarde si le champ de la recherche est rempli
            $values['login'] = $_POST["login"]; // si oui mettre dans le tableau associatif, la cle qui est le nom de la colone dans la bdd et sa valeur
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

        Session::getInstance()->enregistrer("requeteFiltrePersonnel", $values); // enregistrement des différents filtres appliqué
        self::afficherGestionPersonnel();
    }

    public static function supprimerFiltrePersonnel()
    {
        //supprimer la recherche
        Session::getInstance()->supprimer("requeteFiltrePersonnel");
        self::afficherGestionPersonnel();
    }

    public static function afficherTableauDeBord()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            if (Session::getInstance()->contient("requeteFiltreTB")) {
                $nombreStageTrouve = (new EtudiantRepository())->nombreDePersonneTrouveStage(Session::getInstance()->lire("requeteFiltreTB"));
                $nombreAlternanceTrouve = (new EtudiantRepository())->nombreDePersonneTrouveAlternance(Session::getInstance()->lire("requeteFiltreTB"));
                $nombreEnRecherche = (new EtudiantRepository())->nombreEtudiant(Session::getInstance()->lire("requeteFiltreTB")) - $nombreStageTrouve - $nombreAlternanceTrouve;
            } else {
                $nombreStageTrouve = (new EtudiantRepository())->nombreDePersonneTrouveStage([]);
                $nombreAlternanceTrouve = (new EtudiantRepository())->nombreDePersonneTrouveAlternance([]);
                $nombreEnRecherche = (new EtudiantRepository())->nombreEtudiant([]) - $nombreStageTrouve - $nombreAlternanceTrouve;
            }

            if (Session::getInstance()->contient("requeteFiltreTBConvention")) {
                if(Session::getInstance()->lire("requeteFiltreTBConvention")["validation"] == "pedagogique"){
                    $nbreConventionValidePedagogique = (new ConventionStageRepository())->nbreConventionValidePedagogique();
                    $nbreConventionNonValidePedagogique = (new ConventionStageRepository())->nbreConventionNonValidePedagogique();
                }else{
                    $nbreConventionValidePedagogique = (new ConventionStageRepository())->nbreConventionValide();
                    $nbreConventionNonValidePedagogique = (new ConventionStageRepository())->nbreConventionNonValide();
                }
            } else {
                $nbreConventionValidePedagogique = (new ConventionStageRepository())->nbreConventionValidePedagogique();
                $nbreConventionNonValidePedagogique = (new ConventionStageRepository())->nbreConventionNonValidePedagogique();
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Personnel/vueBord.php", "title" => "Tableau De Bord", "nombreStageTrouve" => $nombreStageTrouve, "nombreAlternanceTrouve" => $nombreAlternanceTrouve, "nombreEnRecherche" => $nombreEnRecherche, "nbreConventionValidePedagogique" => $nbreConventionValidePedagogique, "nbreConventionNonValidePedagogique" => $nbreConventionNonValidePedagogique]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function filtrerTB()
    {
        $values = null;
        $convention = null;
        if (isset($_POST["but_annee"]) && $_POST["but_annee"] != "") {
            if ($_POST["but_annee"] != 0) {
                $values['promotion'] = $_POST["but_annee"];
            }
            Session::getInstance()->enregistrer("requeteFiltreTB", $values);
        }
        if (isset($_POST["validation"]) && $_POST["validation"] != "") {
            $convention['validation'] = $_POST["validation"];
            Session::getInstance()->enregistrer("requeteFiltreTBConvention", $convention);
        }
        self::afficherTableauDeBord();
    }


    public static function afficherEtudiantStage()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {


            $etudiants = (new EtudiantRepository())->recupererEtudiantStage();

            $tableauParPage = null;
            if ($etudiants == null) {
                $nbrePages = 1;
                $page = 1;
            } else {

                //Pagination
                $nombresEtudiant = count($etudiants);
                $nbrePages = ceil($nombresEtudiant / 9);

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
                if ($page * 9 > $nombresEtudiant) {
                    $y = $nombresEtudiant;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $etudiants[$i];
                }

            }
            $titre = "Liste des étudiants en stage";
            self::afficherVue("vueGenerale.php", ["contenu" => "Personnel/vueListeEtudiant.php", "Liste des étudiants en stage" => $titre, "etudiants" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des étudiants en stage"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherEtudiantAlternance()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {


            $etudiants = (new EtudiantRepository())->recupererEtudiantAlternance();

            $tableauParPage = null;
            if ($etudiants == null) {
                $nbrePages = 1;
                $page = 1;
            } else {

                //Pagination
                $nombresEtudiant = count($etudiants);
                $nbrePages = ceil($nombresEtudiant / 9);

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
                if ($page * 9 > $nombresEtudiant) {
                    $y = $nombresEtudiant;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $etudiants[$i];
                }

            }
            $titre = "Liste des étudiants en stage";
            self::afficherVue("vueGenerale.php", ["contenu" => "Personnel/vueListeEtudiant.php", "Liste des étudiants en stage" => $titre, "etudiants" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des étudiants en alternance"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherListeEntrepriseStage()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {

            $entreprises = (new EntrepriseRepository())->recupererEntrepriseStage();

            $tableauParPage = null;
            if ($entreprises == null) {
                $nbrePages = 1;
                $page = 1;
            } else {
                //Pagination
                $nombreEntreprise = count($entreprises);
                $nbrePages = ceil($nombreEntreprise / 9);

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
                if ($page * 9 > $nombreEntreprise) {
                    $y = $nombreEntreprise;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $entreprises[$i];
                }
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Entreprise/vueGestionEntreprise.php", "entreprises" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des entreprises avec un élèves en stage"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }


    public static function afficherListeEntrepriseAlternance()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {

            $entreprises = (new EntrepriseRepository())->recupererEntrepriseAlternance();

            $tableauParPage = null;
            if ($entreprises == null) {
                $nbrePages = 1;
                $page = 1;
            } else {
                //Pagination
                $nombreEntreprise = count($entreprises);
                $nbrePages = ceil($nombreEntreprise / 9);

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
                if ($page * 9 > $nombreEntreprise) {
                    $y = $nombreEntreprise;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $entreprises[$i];
                }
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Entreprise/vueGestionEntreprise.php", "entreprises" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des entreprises avec un élèves en alternance"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }
}