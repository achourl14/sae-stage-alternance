<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Etudiant;
use App\Modele\DataObject\Postuler;
use App\Modele\HTTP\Session;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\PostulerRepository;

class ControleurEtudiant extends ControleurGenerique
{

    public static function supprimerEtu(): void
    {

        $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET['login']);
        echo '<div class="msgConfirmation"><p> L\'étudiant ' . $etudiant->getNom() . ' a été supprimé</p></div>';
        self::afficherVue('vueGenerale.php', ["contenu" => "Generale/index.html", "title" => "Accueil"]);
        (new EtudiantRepository())->supprimer($_GET['login']);
    }


    public static function afficherDeleteEtu()
    {
        $etudiant = (new EntrepriseRepository())->recupererParClePrimaire($_GET["login"]);
        self::afficherVue('vueGenerale.php', ["contenu" => "Etudiant/formulaireSuppressionEtu.php", "title" => "Supprimer Etudiant", ["etudiant" => $etudiant]]);
    }


    public static function verifierEtudiantExistant()
    {
        if (isset($_POST['login'])) {
            $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_POST['login']);
            // Retourner l'étudiant en format JSON
            header('Content-Type: application/json');
            echo json_encode(['etudiant' => $etudiant]);
        } else {
            // Retourner null en format JSON
            header('Content-Type: application/json');
            echo json_encode(['etudiant' => null]);
        }
    }


    public static function afficherEtudiant()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            self::afficherVue("Etudiant/InscriptionEtudiant.html");
        }
    }


    public static function creerEtudiant(): void
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            $etudiant = Etudiant::construireDepuisFormulaire($_POST);
            (new EtudiantRepository())->sauvegarder($etudiant);
            echo '<div class="msgConfirmation"><p> L\'étudiant a bien été enregistrée </p></div>';
            self::afficherEtudiant();
        }
    }

    public static function afficherGestionEtudiant()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            if (!Session::getInstance()->contient("requeteFiltreEtudiant")) {
                $etudiants = (new EtudiantRepository())->recuperer();
            } else {
                $etudiants = (new EtudiantRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreEtudiant"));
            }
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
            self::afficherVue("vueGenerale.php", ["contenu" => "Etudiant/vueGestionEtudiant.php", "etudiants" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestions des Etudiants"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailEtudiant()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "Etudiant/vueDetailEtudiant.php", "title" => "Detail Etudiant"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }


    public static function afficherMAJEtudiant()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["login"] || ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET["login"]);
            if ($etudiant != null) {
                self::afficherVue("Etudiant/vueMiseAJourEtudiant.php", ["etudiant" => $etudiant]);
            } else {
                self::afficherErreur("L'étudiant n'est pas enregistrée");
            }

        } else {
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJEtudiant()
    {
        if (isset($_POST["login"])) {
            $etudiantAVerifier = (new EtudiantRepository())->recupererParClePrimaire($_POST["login"]);
            if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA() || $etudiantAVerifier->getPremiereConnexion() == 0) {
                if ($etudiantAVerifier->getPremiereConnexion() == 0) {
                    if ($_POST['mdp'] != $_POST['mdp2']) {
                        echo '<div class="msgConfirmation"><p> ⚠️ Vos 2 champs de mot de passe ne correspondent pas ⚠️  </p></div>';
                        self::afficherMAJEtudiant();
                    } else {
                        $mdpHache = MotDePasse::hacher($_POST['mdp']);
                        $etudiant = new Etudiant($_POST["login"], $_POST["num_etudiant"], $_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["promotion"], $_POST["groupe"], $_POST["parcours"], $_POST["telephone"], $mdpHache, $_POST["date_de_naissance"], $_POST["mailPerso"], $_POST["sexe"], 1);
                        (new EtudiantRepository())->mettreAJour($etudiant);
                        echo '<div class="msgConfirmation"><p> L\'étudiant a bien été mis à jour </p></div>';
                        self::afficherAccueil();
                    }
                } else {
                    $etudiant = new Etudiant($_POST["login"], $_POST["num_etudiant"], $_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["promotion"], $_POST["groupe"], $_POST["parcours"], $_POST["telephone"], $etudiantAVerifier->getMdp(), $_POST["date_de_naissance"], $_POST["mailPerso"], $_POST["sexe"], 1);
                    (new EtudiantRepository())->mettreAJour($etudiant);
                    echo '<div class="msgConfirmation"><p> Les informations de l\'étudiant ' . $etudiant->getLogin() . ' ont bien été mis à jour </p></div>';
                    self::afficherAccueil();
                }

            } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["login"]) {
                if (isset($_POST["mdp"])) {
                    $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $etudiantAVerifier->getMdp());
                    if (!$mdpCorrect) {
                        self::afficherErreur("Mot de passe Incorrect");
                    } else {
                        $etudiant = new Etudiant($_POST["login"], $_POST["num_etudiant"], $_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["promotion"], $_POST["groupe"], $_POST["parcours"], $_POST["telephone"], $etudiantAVerifier->getMdp(), $_POST["date_de_naissance"], $_POST["mailPerso"], $_POST["sexe"], 1);
                        (new EtudiantRepository())->mettreAJour($etudiant);
                        self::afficherErreur("Vos informations " . $etudiant->getLogin() . " ont bien été mis à jour");
                    }
                } else {
                    self::afficherErreur("Veuillez rentrer votre mot de passe");
                }

            } else {
                self::afficherErreur("Vous n'avez pas les droits");
            }
        }
    }

    public static function rechercherEtudiant()
    {
        $values = null;
        if (isset($_POST["login"]) && $_POST["login"] != "") {
            $values['login'] = $_POST["login"];
        }
        if (isset($_POST["num_etudiant"]) && $_POST["num_etudiant"] != "") {
            $values['codeEtudiant'] = $_POST["num_etudiant"];
        }
        if (isset($_POST["nom_etudiant"]) && $_POST["nom_etudiant"] != "") {
            $values['nomEtudiant'] = $_POST["nom_etudiant"];
        }
        if (isset($_POST['prenom']) && $_POST["prenom"] != "") {
            $values['prenomEtudiant'] = $_POST['prenom'];
        }
        if (isset($_POST['mail']) && $_POST["mail"] != "") {
            $values['mailEtudiant'] = $_POST['mail'];
        }
        if (isset($_POST['telephone']) && $_POST["telephone"] != "") {
            $values['telephoneEtudiant'] = $_POST['telephone'];
        }
        if (isset($_POST['promotion']) && $_POST["promotion"] != "") {
            $values['promotion'] = $_POST['promotion'];
        }
        if (isset($_POST['date_de_naissance']) && $_POST["date_de_naissance"] != "") {
            $values['dateNaissanceEtudiant'] = $_POST['date_de_naissance'];
        }
        if (isset($_POST['groupe']) && $_POST["groupe"] != "") {
            $values['groupe'] = $_POST['groupe'];
        }

        Session::getInstance()->enregistrer("requeteFiltreEtudiant", $values);
        self::afficherGestionEtudiant();
    }

    public static function supprimerFiltreEtudiant()
    {
        Session::getInstance()->supprimer("requeteFiltreEtudiant");
        self::afficherGestionEtudiant();
    }

    public static function afficherVuePostuler()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "Etudiant/vuePostuler.php", "title" => "Ajouter CV", "offreId" => $_GET['idOffre']]);
    }

    public static function postulerBD()
    {
        if (ConnexionUtilisateur::estEtudiant()) {
            $postulerExiste = (new PostulerRepository())->recupererParClePrimaire(ConnexionUtilisateur::getLoginUtilisateurConnecte(), $_GET['idOffre']);
            if ($postulerExiste != null) {
                self::afficherErreur("Vous avez déjà postuler à cette offre", "offres");
            } else {
                $postuler = new Postuler(ConnexionUtilisateur::getLoginUtilisateurConnecte(), $_GET['idOffre'], -9);
                (new PostulerRepository())->sauvegarder($postuler);
                self::afficherErreur("Vous avez bien postulé pour cette offre");
            }
        }
    }

    public static function postuler()
    {
        if (ConnexionUtilisateur::estEtudiant()) {
            $nomFichier = $_FILES["cvEtu"]["name"];
            $dossier = $_FILES["cvEtu"]["tmp_name"];
            move_uploaded_file("$dossier", "../upload_postuler/$nomFichier");
            $file_parts = pathinfo("../upload_postuler/$nomFichier");
            if ($file_parts['extension'] != "pdf" && $file_parts['extension'] != "docx" && $file_parts['extension'] != "txt") {
                unlink("../upload_postuler/$nomFichier");
                echo '<div class="msgConfirmation"><p> Impossible de postuler : Le fichier CV n\'est pas dans les extensions demandées (.pdf, .docx, .txt)</p></div>';
            } else {
                rename("../upload_postuler/$nomFichier", "../upload_postuler/cv_postuler_" . $_GET['idOffre'] . "_" . ConnexionUtilisateur::getLoginUtilisateurConnecte() . "." . $file_parts['extension']);

                if (file_exists($_FILES['lettreMotivation']['tmp_name']) && is_uploaded_file($_FILES['lettreMotivation']['tmp_name'])) {
                    $nomFichier = $_FILES["lettreMotivation"]["name"];
                    $dossier = $_FILES["lettreMotivation"]["tmp_name"];
                    move_uploaded_file("$dossier", "../upload_postuler/$nomFichier");
                    $file_parts = pathinfo("../upload_postuler/$nomFichier");
                    if ($file_parts['extension'] != "pdf" && $file_parts['extension'] != "docx" && $file_parts['extension'] != "txt") {
                        unlink("../upload_postuler/$nomFichier");
                        echo '<div class="msgConfirmation"><p> Impossible de postuler : Le fichier CV n\'est pas dans les extensions demandées (.pdf, .docx, .txt)</p></div>';
                    } else {
                        rename("../upload_postuler/$nomFichier", "../upload_postuler/lettre_postuler_" . $_GET['idOffre'] . "_" . ConnexionUtilisateur::getLoginUtilisateurConnecte() . "." . $file_parts['extension']);
                        self::postulerBD();
                    }
                } else {
                    self::postulerBD();
                }
            }
        } else {
            self::afficherErreur("Vous n'avez pas la possibilité de postuler à une offre");
        }
    }

    public static function validerOffreDeffinitif()
    {

    }

}