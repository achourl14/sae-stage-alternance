<?php

namespace App\Controleur;

use App\ClassTest;
use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Entreprise;
use App\Modele\DataObject\Etudiant;
use App\Modele\DataObject\Offre;
use App\Modele\DataObject\Postuler;
use App\Modele\DataObject\Secretariat;
use App\Modele\DataObject\Stage;
use App\Modele\HTTP\Session;
use App\Modele\Repository\AlternanceRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\OffreRepository;
use App\Modele\Repository\PostulerRepository;
use App\Modele\Repository\SecretariatRepository;
use App\Modele\Repository\StageRepository;
use App\Modele\Repository\ConnexionBaseDeDonnee;


class Controleur extends ControleurGenerique
{

    public static function creerEntreprise(): void
    {
        if ((new EntrepriseRepository())->recupererParClePrimaire($_POST['num_siret']) != null) {
            echo '<div class="msgConfirmation"><p> ⚠️ Le numéro de Siret est déjà enregistré, veuillez contacter l\'IUT ⚠️  </p></div>';
            self::afficherInscription();
        } else {
            if ($_POST['mdp'] != $_POST['mdp2']) {
                echo '<div class="msgConfirmation"><p> ⚠️ Vos 2 champs de mot de passe ne correspondent pas ⚠️  </p></div>';
                self::afficherInscription();
            } else {
                $entreprise = Entreprise::construireDepuisFormulaire($_POST);
                EntrepriseRepository::sauvegarder($entreprise);
                echo '<div class="msgConfirmation"><p> L\'entreprise a bien été enregistrée </p></div>';
                self::afficherAccueil();
            }
        }
    }

    // creer un offre de Stage ou d'Alternance
    /*
    Offre Alternance => table offre_alternance
    Offre de stage => table offre_stage
    */
    public static function entrepriseStageExterne(): void
    {
        $entreprise = new Entreprise($_POST["num_siret"], $_POST["nom_entreprise"], $_POST["adresse"], $_POST["telephone"], $_POST["mail"], null, $_POST["code_ape"], null, null);
        EntrepriseRepository::sauvegarder($entreprise);
        echo '<div class="msgConfirmation"><p> Vous avez bien inscrit votre entreprise du nom de : ' . $_POST["nom_entreprise"] . '</p></div>';
        self::afficherAccueil();
    }

    public static function creerStageExterne(): void
    {
        $stage = $_POST['stage'];

        self::entrepriseStageExterne();

        if ($stage == "Stage") {
            $alternanceStageEtudiant = new Stage($_POST["idEtudiantStage"], 0, $_POST["numMaitreStage"], $_POST["idTuteurStage"], $_POST["dateDebutStage"], $_POST["dateFinStage"], $_POST["remuneration"], $_POST["num_siret"]);
            StageRepository::sauvegarder($alternanceStageEtudiant);
        } else {
            $alternanceExterneEtudiant = new Alternance($_POST["idEtudiantStage"], 0, $_POST["numMaitreStage"], $_POST["idTuteurStage"], $_POST["dateDebutStage"], $_POST["dateFinStage"], $_POST["remuneration"], $_POST["num_siret"]);
            AlternanceRepository::sauvegarder($alternanceExterneEtudiant);
        }
    }

    public static function offres()
    {
        if (!Session::getInstance()->contient("requeteFiltreOffre")) {
            if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
                $offres = (new OffreRepository())->recuperer();
            } else {
                $offres = (new OffreRepository())->recupererOffreValide();
            }
        } else {
            $offres = (new OffreRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreOffre"));
        }

        if ($offres == null) {
            self::afficherErreur("Aucune offres disponible, veuillez revenir plus tard", "offres");
        } else {
            foreach ($offres as $offreFormatTableau) {
                $tableauTout[] = $offreFormatTableau;
            }

            $tableauParPage = null;

            //Pagination
            $nombresOffre = count($offres);
            $nbrePages = ceil($nombresOffre / 9);

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
            if ($page * 9 > $nombresOffre) {
                $y = $nombresOffre;
            }

            for ($i = ($page - 1) * 9; $i < $y; $i++) {
                $tableauParPage[] = $tableauTout[$i];
            }
            $title = "Liste des offres";
            if(ConnexionUtilisateur::estMaitreSA()){
                $title = "Gestions des offres";
            }

            self::afficherVue("vueGenerale.php", ["contenu" => "vueOffres.php", "offreses" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => $title]);
        }
    }

    public static function validerOffre()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            $offre = (new OffreRepository())->recupererParClePrimaire($_GET['id']);
            OffreRepository::validerOffre($offre);
            $msg = "";
            if ($offre->getValidation()) {
                $msg = "invalider";
            } else {
                $msg = "valider";
            }
            echo '<div class="msgConfirmation"><p> Vous avez bien ' . $msg . ' l\'offre de Stage : ' . $offre->getNomOffre() . '</p></div>';
            self::offres();
        } else {
            echo '<div class="msgConfirmation"><p>Vous n\'avez pas les droits de valider ou dévalider les offres</p></div>';
        }
    }

    public static function creerOffre()
    {
        $nomFichier = $_FILES["fileToUpload"]["name"];
        $dossier = $_FILES["fileToUpload"]["tmp_name"];
        move_uploaded_file("$dossier", "../upload_offres/$nomFichier");
        $file_parts = pathinfo("../upload_offres/$nomFichier");
        if ($file_parts['extension'] != "pdf" && $file_parts['extension'] != "docx" && $file_parts['extension'] != "txt") {
            unlink("../upload_offres/$nomFichier");
            echo '<div class="msgConfirmation"><p> Impossible de créer l\'offre : Le fichier n\'est pas dans les extensions demandées (.pdf, .docx, .txt)</p></div>';
        } else {
            $offre = null;
            $offre = new Offre(-9, $_POST["idEntreprise"], $_POST["nomOffre"], $_POST["mission"], -9, -9, $_POST["dateDebut"], $_POST["dateFin"], $_POST["remuneration"], $_POST["but_annee"], $_POST["parcours"], $_POST["type"], 0);
            OffreRepository::sauvegarder($offre);

            $offreCree = (new OffreRepository())->derniereOffre();
            rename("../upload_offres/$nomFichier", "../upload_offres/offre_" . $offreCree->getIdOffre() . "." . $file_parts['extension']);

            echo '<div class="msgConfirmation"><p> Vous avez bien créer votre offre : ' . $offre->getNomOffre() . '</p></div>';
        }
        self::offres();
    }

    public static function supprimerCompteEntreprise():void{

        $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET['numSiret']);
        echo '<div class="msgConfirmation"><p> L\'entreprise ' . $entreprise->getNomEntreprise().' a été supprimée ainsi que toutes les offres associées</p></div>';
        self::afficherVue('vueGenerale.php', ["contenu" => "index.html","title"=>"Accueil"]);
        (new OffreRepository())->supprimer($_GET['idEntreprise']);
        (new EntrepriseRepository())->supprimer($_GET['numSiret']);
    }

    public static function afficherDeleteEntreprise(){
        $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
        self::afficherVue('vueGenerale.php',["contenu"=> "formulaireSuppressionEntreprise.php","title"=> "Supprimer Entreprise",["entreprise"=> $entreprise]]);
    }

    public static function filtrer()
    {
        $type = null;
        $values = null;
        if(isset($_POST['Stage']) && isset($_POST['Alternance']) && isset($_POST["StageAlternance"]) || !isset($_POST['Stage']) && !isset($_POST['Alternance']) && !isset($_POST["StageAlternance"]) ){
            $type = null;
        }else{
            if (isset($_POST['Stage'])) {
                $type[] = "S";
            }
            if (isset($_POST['Alternance'])) {
                $type[] = "A";
            }
            if (isset($_POST['StageAlternance'])) {
                $type[] = "SA";
            }
            $values["type"] = $type;
        }
            if(isset($_POST['Avalider']) && isset($_POST['Valider'])){

            }else if(isset($_POST['Avalider']) || isset($_POST['Valider'])) {
                if (isset($_POST['Valider'])) {
                    $validation = 1;
                    $values["validation"] = $validation;
                }
                if (isset($_POST['Avalider'])) {
                    $validation = 0;
                    $values["validation"] = $validation;
                }

            }

        if(isset($_POST['nosOffres'])){
            $values["idEntreprise"] = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        }
        Session::getInstance()->enregistrer("requeteFiltreOffre", $values);
        self::offres();
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

    public static function deconnecter()
    {
        ConnexionUtilisateur::deconnecter();
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

    public static function afficherAccueil()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "index.html", "title" => "Accueil"]);
    }

    public static function afficherInscription()
    {
        self::afficherVue("inscription.html");
    }

    public static function afficherFormulaire()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "formulaireoffre.php", "title" => "Création Offre"]);
    }

    public static function afficherConnexion()
    {
        self::afficherVue("connexion.html");
    }

    public static function afficherDetail()
    {
        if (!isset($_GET["idOffre"])) {
            self::afficherErreur("L'id de l'offre n'est pas renseigné");
        } else {
            self::afficherVue("vueGenerale.php", ["title" => "Detail offre", "contenu" => "vueDetail.php", "offreDetail" => $_GET["idOffre"]]);
        }
    }

    public static function afficherFormulaireExterne()
    {
        self::afficherVue("vueGenerale.php", ["title" => "FormulaireExterne", "contenu" => "formulaireOffreExterneStage.html"]);
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
        if (ClassTest::$DEBUG == true) {
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

    public static function afficherSecretaire()
    {
        if(ConnexionUtilisateur::estMaitreSA()){
            self::afficherVue("InscriptionSecretariat.html");
        }
    }

    public static function creerSecretaire(): void
    {
        if(ConnexionUtilisateur::estMaitreSA()){
            $secretaire = Secretariat::construireDepuisFormulaire($_POST);
            SecretariatRepository::sauvegarder($secretaire);
            echo '<div class="msgConfirmation"><p> Le Secrétaire a bien été enregistrée </p></div>';
            self::afficherAccueil();
        }
    }

    public static function afficherEtudiant()
    {
        if(ConnexionUtilisateur::estMaitreSA()){
            self::afficherVue("InscriptionEtudiant.html");
        }
    }



    public static function creerEtudiant(): void
    {
        if(ConnexionUtilisateur::estMaitreSA()){
            $etudiant = Etudiant::construireDepuisFormulaire($_POST);
            (new EtudiantRepository())->sauvegarder($etudiant);
            echo '<div class="msgConfirmation"><p> L\'étudiant a bien été enregistrée </p></div>';
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
            self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueGestionEtudiant.php", "etudiants" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestions des Etudiants"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailEtudiant()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueDetailEtudiant.php", "title" => "Detail Etudiant"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherGestionEntreprise()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            if (!Session::getInstance()->contient("requeteFiltreEntreprise")) {
                $entreprises = (new EntrepriseRepository())->recuperer();
            } else {
                $entreprises = (new EntrepriseRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreEntreprise"));
            }
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
            self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueGestionEntreprise.php", "entreprises" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestion des Entreprises"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailEntreprise()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueDetailEntreprise.php", "title" => "Detail Entreprise"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherMAJEntreprise()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["numSiret"] || ConnexionUtilisateur::estMaitreSA()) {
            $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
            if ($entreprise != null) {
                self::afficherVue("FormulaireMiseAJour/vueMiseAJourEntreprise.php", ["entreprise" => $entreprise]);
            } else {
                self::afficherErreur("L'entreprise n'est pas enregistrée");
            }

        } else {
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJEntreprise()
    {
        if (isset($_POST["num_siret"])) {
            $entrepriseAVerifier = (new EntrepriseRepository())->recupererParClePrimaire($_POST["num_siret"]);
            if (ConnexionUtilisateur::estMaitreSA()) {
                $entreprise = new Entreprise($_POST["num_siret"], $_POST["nom_entreprise"], $_POST["adresse"], $_POST["telephone"], $_POST["mail"], $_POST["interlocuteur"], $_POST["code_ape"], $_POST["activite"], $entrepriseAVerifier->getMdp());
                (new EntrepriseRepository())->mettreAJour($entreprise);
                self::afficherErreur("Les informations de l'entreprise " . $entreprise->getNomEntreprise() . " ont bien été mis à jour");
            } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["num_siret"]) {
                if (isset($_POST["mdp"])) {
                    $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $entrepriseAVerifier->getMdp());
                    if (!$mdpCorrect) {
                        self::afficherErreur("Mot de passe Incorrect");
                    } else {
                        $entreprise = Entreprise::construireDepuisFormulaire($_POST);
                        (new EntrepriseRepository())->mettreAJour($entreprise);
                        self::afficherErreur("Les informations de votre entreprise " . $entreprise->getNomEntreprise() . " ont bien été mis à jour");
                    }
                } else {
                    self::afficherErreur("Veuillez rentrer votre mot de passe");
                }

            } else {
                self::afficherErreur("Vous n'avez pas les droits");
            }
        }
        self::afficherAccueil();
    }

    public static function afficherMAJEtudiant()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["codeINE"] || ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET["codeINE"]);
            if ($etudiant != null) {
                self::afficherVue("FormulaireMiseAJour/vueMiseAJourEtudiant.php", ["etudiant" => $etudiant]);
            } else {
                self::afficherErreur("L'étudiant n'est pas enregistrée");
            }

        } else {
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJEtudiant()
    {
        if (isset($_POST["code_INE"])) {
            $etudiantAVerifier = (new EtudiantRepository())->recupererParClePrimaire($_POST["code_INE"]);
            if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
                $etudiant = new Etudiant($_POST["code_INE"], $_POST["num_etudiant"], $_POST["groupe"], $_POST["nom"], $_POST["prenom"], $_POST["parcours"], $_POST["telephone"], $_POST["mail"], $etudiantAVerifier->getMdp(), $_POST["date_de_naissance"], $_POST["promotion"]);
                (new EtudiantRepository())->mettreAJour($etudiant);
                self::afficherErreur("Les informations de l'étudiant " . $etudiant->getCodeINE() . " ont bien été mis à jour");
            } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["code_INE"]) {
                if (isset($_POST["mdp"])) {
                    $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $etudiantAVerifier->getMdp());
                    if (!$mdpCorrect) {
                        self::afficherErreur("Mot de passe Incorrect");
                    } else {
                        $etudiant = new Etudiant($_POST["code_INE"], $_POST["num_etudiant"], $_POST["groupe"], $_POST["nom"], $_POST["prenom"], $_POST["parcours"], $_POST["telephone"], $_POST["mail"], $etudiantAVerifier->getMdp(), $_POST["date_de_naissance"], $_POST["promotion"]);
                        (new EtudiantRepository())->mettreAJour($etudiant);
                        self::afficherErreur("Vos informations " . $etudiant->getCodeINE() . " ont bien été mis à jour");
                    }
                } else {
                    self::afficherErreur("Veuillez rentrer votre mot de passe");
                }

            } else {
                self::afficherErreur("Vous n'avez pas les droits");
            }
        }
        self::afficherAccueil();
    }

    public static function rechercherEtudiant()
    {
        $values = null;
        if (isset($_POST["code_INE"]) && $_POST["code_INE"] != "") {
            $values['codeINE'] = $_POST["code_INE"];
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

    public static function rechercherEntreprise()
    {
        $values = null;
        if (isset($_POST["num_siret"]) && $_POST["num_siret"] != "") {
            $values['numSiret'] = $_POST["num_siret"];
        }
        if (isset($_POST["nom_entreprise"]) && $_POST["nom_entreprise"] != "") {
            $values['nomEntreprise'] = $_POST["nom_entreprise"];
        }
        if (isset($_POST["adresse"]) && $_POST["adresse"] != "") {
            $values['adresseEntreprise'] = $_POST["adresse"];
        }
        if (isset($_POST['interlocuteur']) && $_POST["interlocuteur"] != "") {
            $values['interlocuteurPrincipal'] = $_POST['interlocuteur'];
        }
        if (isset($_POST['mail']) && $_POST["mail"] != "") {
            $values['adressemail'] = $_POST['mail'];
        }
        if (isset($_POST['telephone']) && $_POST["telephone"] != "") {
            $values['telephoneEntreprise'] = $_POST['telephone'];
        }
        if (isset($_POST['code_ape']) && $_POST["code_ape"] != "") {
            $values['codeAPE'] = $_POST['code_ape'];
        }
        if (isset($_POST['secteur_activite']) && $_POST["secteur_activite"] != "") {
            $values['secteurActivite'] = $_POST['secteur_activite'];
        }
        Session::getInstance()->enregistrer("requeteFiltreEntreprise", $values);
        self::afficherGestionEntreprise();
    }

    public static function supprimerFiltreEntreprise()
    {
        Session::getInstance()->supprimer("requeteFiltreEntreprise");
        self::afficherGestionEntreprise();
    }

    public static function afficherMenuPostulerOffre()
    {
        if (ConnexionUtilisateur::estEtudiant()) {
            $postulers = (new PostulerRepository())->recupererParEtudiant(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            $offresCandidate = null;
            if ($postulers != null) {
                foreach ($postulers as $postuler) {
                    $offresCandidate[] = (new OffreRepository())->recupererParClePrimaire($postuler->getIdOffre());
                }
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "vueMenuPostulerOffre.php", "title" => "Vos candidatures", "offresCandidate" => $offresCandidate]);
        }
    }

    public static function afficherVuePostuler()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "vuePostuler.php", "title" => "Ajouter CV", "offreId" => $_GET['idOffre']]);
    }

    public static function postulerBD()
    {
        if(ConnexionUtilisateur::estEtudiant()) {
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
        }else{
            self::afficherErreur("Vous n'avez pas la possibilité de postuler à une offre");
        }
    }

    public static function afficherVueEntrepriseCandidature(){
        $offre = (new OffreRepository())->recupererParClePrimaire($_GET['idOffre']);
        if($offre->getIdEntreprise() == ConnexionUtilisateur::getLoginUtilisateurConnecte()){
            $postulers = (new PostulerRepository())->recupererParOffre($_GET['idOffre']);
            self::afficherVue("vueGenerale.php", ["contenu" => "vueEntrepriseCandidature.php", "title" => "Candidatures", "postulers"=>$postulers]);
        }else{
            self::afficherErreur("Vous n'avez pas le droit de faire cela");
        }

    }

    public static function accepterCandidature(){
        $postuler = (new PostulerRepository())->recupererParClePrimaire($_GET["codeINE"],$_GET["idOffre"]);
        $postuler->setEtat(1);
        (new PostulerRepository())->mettreAJourEtat($postuler);
    }

    public static function refuserCandidature(){
        $postuler = (new PostulerRepository())->recupererParClePrimaire($_GET["codeINE"],$_GET["idOffre"]);
        $postuler->setEtat(2);
        (new PostulerRepository())->mettreAJourEtat($postuler);
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
            self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueGestionPersonnel.php", "personnels" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestions du Personnel"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailPersonnel()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueDetailPersonnel.php", "title" => "Detail Personnel"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherMAJPersonnel()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["idSecretariat"] || ConnexionUtilisateur::estMaitreSA()) {
            $personnel = (new SecretariatRepository())->recupererParClePrimaire($_GET["idSecretariat"]);
            if ($personnel != null) {
                self::afficherVue("FormulaireMiseAJour/vueMiseAJourPersonnel.php", ["personnel" => $personnel]);
            } else {
                self::afficherErreur("Le personnel de l'iut n'est pas enregistrée");
            }

        } else {
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJPersonnel()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["idSecretariat"] || ConnexionUtilisateur::estMaitreSA()) {
            if (isset($_POST["idSecretariat"])) {
                $secretaireAVerifier = (new SecretariatRepository())->recupererParClePrimaire($_POST["idSecretariat"]);
                if (ConnexionUtilisateur::estSecretariat()) {
                    $secretaire = new Secretariat($_POST["idSecretariat"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"], $secretaireAVerifier->getMdp());
                    (new SecretariatRepository())->mettreAJour($secretaire);
                    self::afficherErreur("Les informations du personnel " . $secretaire->getIdSecretariat() . " ont bien été mis à jour");
                } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["idSecretariat"]) {
                    if (isset($_POST["mdp"])) {
                        $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $secretaireAVerifier->getMdp());
                        if (!$mdpCorrect) {
                            self::afficherErreur("Mot de passe Incorrect");
                        } else {
                            $secretaire = new Secretariat($_POST["idSecretariat"], $_POST["nomSecretariat"], $_POST["prenomSecretariat"], $_POST["mailSecretariat"], $_POST["telephoneSecretariat"], $_POST["dateDeNaissanceSecretariat"], $secretaireAVerifier->getMdp());
                            (new SecretariatRepository())->mettreAJour($secretaire);
                            self::afficherErreur("Vos informations " . $secretaire->getIdSecretariat() . " ont bien été mis à jour");
                        }
                    } else {
                        self::afficherErreur("Veuillez rentrer votre mot de passe");
                    }

                } else {
                    self::afficherErreur("Vous n'avez pas les droits");
                }
            }
            self::afficherAccueil();
        }
    }

    public static function rechercherPersonnel()
    {
        $values = null;
        if (isset($_POST["idSecretariat"]) && $_POST["idSecretariat"] != "") {
            $values['idSecretariat'] = $_POST["idSecretariat"];
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