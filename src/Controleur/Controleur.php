<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Entreprise;
use App\Modele\DataObject\Offre;
use App\Modele\DataObject\Stage;
use App\Modele\HTTP\Session;
use App\Modele\Repository\AlternanceRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\OffreRepository;
use App\Modele\Repository\SecretariatRepository;
use App\Modele\Repository\StageRepository;


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

    public static function consulterOffre()
    {
        $offres = (new OffreRepository())->recupererOffreValide();

        $tableauTout = null;

        if ($offres == null) {
            self::afficherAucuneOffre();
        }else{
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
            self::afficherVue("vueGenerale.php", ["contenu" => "vueOffres.php", "offreses" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des offres"]);
        }
    }

    public static function consulterOffreSecretaire()
    {

        $offres = (new OffreRepository())->recuperer();

        if ($offres == null) {
            self::afficherAucuneOffre();
        }else{
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
            self::afficherVue("vueGenerale.php", ["contenu" => "vueValiderOffre.php", "offreses" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des offres à valider"]);
        }
    }

    public static function validerOffre()
    {
        if (ConnexionUtilisateur::estSecretariat()) {
            $offre = (new OffreRepository())->recupererParClePrimaire($_GET['id']);
            OffreRepository::validerOffre($offre);
            $msg = "";
            if ($offre->getValidation()) {
                $msg = "invalider";
            } else {
                $msg = "valider";
            }
            echo '<div class="msgConfirmation"><p> Vous avez bien ' . $msg . ' l\'offre de Stage : ' . $offre->getNomOffre() . '</p></div>';
            self::consulterOffreSecretaire();
        } else {
            echo '<div class="msgConfirmation"><p>Vous n\'avez pas les droits de valider ou dévalider les offres</p></div>';
        }
    }

    public static function creerOffre()
    {
        $offre = null;
        $offre = new Offre(-9,$_POST["idEntreprise"],$_POST["nomOffre"], $_POST["mission"], -9, -9, $_POST["dateDebut"],$_POST["dateFin"],$_POST["remuneration"],$_POST["but_annee"],$_POST["parcours"],$_POST["type"],0);
        OffreRepository::sauvegarder($offre);

//        if ($_FILES['fichier']['error']) {
//            switch ($_FILES['fichier']['error']){
//                case 1: // UPLOAD_ERR_INI_SIZE
//                    echo "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
//                    break;
//                case 2: // UPLOAD_ERR_FORM_SIZE
//                    echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
//                    break;
//                case 3: // UPLOAD_ERR_PARTIAL
//                    echo "L'envoi du fichier a été interrompu pendant le transfert !";
//                    break;
//                case 4: // UPLOAD_ERR_NO_FILE
//                    echo "Le fichier que vous avez envoyé a une taille nulle !";
//                    break;
//            }
//        }else{
//            $nom = $_FILES['fichier']['tmp_name'];
//            $nomdestination = '/FichierOffre';
//            move_uploaded_file($nom, $nomdestination);
//        }
        echo '<div class="msgConfirmation"><p> Vous avez bien créer votre offre : ' . $offre->getNomOffre() . '</p></div>';
        self::consulterOffre();
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

    public static function afficherAucuneOffre()
    {
        self::afficherVue("vueGenerale.php", ["title" => "Indisponible", "contenu" => "vueAucuneOffres.php"]);
    }

    public static function afficherDetail()
    {
        self::afficherVue("vueGenerale.php", ["title" => "Detail offre", "contenu" => "vueDetail.php"]);
    }

    public static function afficherFormulaireExterne()
    {
        self::afficherVue("vueGenerale.php", ["title" => "FormulaireExterne", "contenu" => "formulaireOffreExterneStage.html"]);
    }

    public static function seDeconnecter()
    {
        ConnexionUtilisateur::deconnecter();
        echo '<div class="msgConfirmation"><p>Vous êtes  bien déconnecté</p></div>';
        self::afficherAccueil();
    }

    public static function estAdmin()
    {
        ConnexionUtilisateur::connecter('admin');
        $cle = 'secretariat';
        $session = Session::getInstance();
        $session->enregistrer($cle, 1);
        $cle = "etudiant";
        $session->enregistrer($cle, 1);
        $cle = "entreprise";
        $session->enregistrer($cle, 1);
        self::afficherAccueil();
    }

//    public static function afficherSecretaire(){
//        self::afficherVue("InscriptionSecretariat.html");
//    }
//
//    public static function creerSecretaire(): void
//    {
//        $secretaire = Secretariat::construireDepuisFormulaire($_POST);
//        SecretariatRepository::sauvegarder($secretaire);
//        echo '<div class="msgConfirmation"><p> Le Secrétaire a bien été enregistrée </p></div>';
//
//    }

}