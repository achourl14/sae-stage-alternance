<?php

namespace App\Controleur;

use App\ClassTest;
use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Entreprise;
use App\Modele\DataObject\Offre;
use App\Modele\DataObject\Stage;
use App\Modele\HTTP\Session;
use App\Modele\Repository\AbstractRepository;
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

    public static function offres($offre=null)
    {
        if(!isset($offre)) {
            if (ConnexionUtilisateur::estSecretariat()) {
                $offres = (new OffreRepository())->recuperer();
            } else {
                $offres = (new OffreRepository())->recupererOffreValide();
            }
        }else{
            $offres = $offre;
        }

        if ($offres == null) {
            self::afficherErreur("Aucune offres disponible, veuillez revenir plus tard");
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
                }else if ($page <= 1){
                    $page= 1;
                }
            }
            $y = $page * 9;
            if ($page * 9 > $nombresOffre) {
                $y = $nombresOffre;
            }

            for ($i = ($page - 1) * 9; $i < $y; $i++) {
                $tableauParPage[] = $tableauTout[$i];
            }

            self::afficherVue("vueGenerale.php", ["contenu" =>  "vueOffres.php", "offreses" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Liste des offres à valider"]);
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
        $offre = new Offre(-9, $_POST["idEntreprise"], $_POST["nomOffre"], $_POST["mission"], -9, -9, $_POST["dateDebut"], $_POST["dateFin"], $_POST["remuneration"], $_POST["but_annee"], $_POST["parcours"], $_POST["type"], 0);
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

    public static function filtrer(){
        $stage = false;
        $alternance= false;
        $valider = false;
        $invalider = false;
        $type = "SA";
        $sa = false;
        $validation = null;

        if ( isset($_POST['Stage']) ){
            $stage = true;
            $type = "S";
        }
        if ( isset($_POST['Alternance']) ){
            $alternance = true;
            $type = "A";
        }
        if ( $stage == true && $alternance == true){
            $type = "SA";
        }
        if ( isset($_POST['Valider']) ){
            $valider = true;
            $validation = 1;
        }
        if ( isset($_POST['Avalider']) ){
            $invalider = true;
            $validation = 0;
        }
        if ( $valider == true && $invalider == true){
            $validation = null;
        }
        if(!isset($_POST['Stage']) && !isset($_POST['Alternance'])){
            $type = null;
        }
        $values = null;
        if($validation != null){
            $values["validation"] = $validation;
        }
        if($type != null){
            $values["type"] = $type;
        }

        $offres = (new OffreRepository())->recupererAvecFiltre($values);
        self::offres($offres);
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

    public static function afficherErreur($message){
        echo '<div class="msgConfirmation"><p>'.$message.'</p></div>';
        self::afficherAccueil();
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
        self::afficherVue("vueGenerale.php", ["title" => "Detail offre", "contenu" => "vueDetail.php"]);
    }

    public static function afficherFormulaireExterne()
    {
        self::afficherVue("vueGenerale.php", ["title" => "FormulaireExterne", "contenu" => "formulaireOffreExterneStage.html"]);
    }

    public static function seDeconnecter()
    {
        if(ConnexionUtilisateur::estConnecte()){
            ConnexionUtilisateur::deconnecter();
            echo '<div class="msgConfirmation"><p>Vous êtes  bien déconnecté</p></div>';
            self::afficherAccueil();
        }else{
            self::afficherErreur("Vous êtes pas connecté");
            self::afficherAccueil();
        }

    }

    public static function estAdmin()
    {
        if(ClassTest::$DEBUG == true){
            ConnexionUtilisateur::connecter('admin');
            $cle = 'secretariat';
            $session = Session::getInstance();
            $session->enregistrer($cle, 1);
            $cle = "etudiant";
            $session->enregistrer($cle, 1);
            $cle = "entreprise";
            $session->enregistrer($cle, 1);
            self::afficherAccueil();
        }else{
            self::afficherErreur("Vous n'avez pas les droits");
        }

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

    public static function afficherGestionEtudiant()
    {
        if(ConnexionUtilisateur::estSecretariat()){
            $etudiants = (new EtudiantRepository())->recuperer();
            if($etudiants == null){
                self::afficherErreur("Aucun Etudiant inscrit sur la plateforme");
            }else{
                $tableauParPage = null;

                //Pagination
                $nombresEtudiant = count($etudiants);
                $nbrePages = ceil($nombresEtudiant / 9);

                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page > $nbrePages) {
                        $page = $nbrePages;
                    }else if ($page <= 1){
                        $page= 1;
                    }
                }
                $y = $page * 9;
                if ($page * 9 > $nombresEtudiant) {
                    $y = $nombresEtudiant;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $etudiants[$i];
                }
                self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueGestionEtudiant.php", "etudiants" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestions des Etudiants"]);
            }
        }else{
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }
    public static function afficherDetailEtudiant(){
        if(ConnexionUtilisateur::estSecretariat()){
            self::afficherVue("vueGenerale.php",["contenu" => "Administration/vueDetailEtudiant.php", "title" => "Detail Etudiant"]);
        }else{
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherGestionEntreprise(){
        if(ConnexionUtilisateur::estSecretariat()){
            $entreprises = (new EntrepriseRepository())->recuperer();
            if($entreprises == null){
                self::afficherErreur("Aucune Entreprise inscrit sur la plateforme");
            }else{
                $tableauParPage = null;

                //Pagination
                $nombreEntreprise = count($entreprises);
                $nbrePages = ceil($nombreEntreprise / 9);

                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page > $nbrePages) {
                        $page = $nbrePages;
                    }else if ($page <= 1){
                        $page= 1;
                    }
                }
                $y = $page * 9;
                if ($page * 9 > $nombreEntreprise) {
                    $y = $nombreEntreprise;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $entreprises[$i];
                }
                self::afficherVue("vueGenerale.php", ["contenu" => "Administration/vueGestionEntreprise.php", "entreprises" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestion des Entreprises"]);
            }
        }else{
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailEntreprise(){
        if(ConnexionUtilisateur::estSecretariat()){
            self::afficherVue("vueGenerale.php",["contenu" => "Administration/vueDetailEntreprise.php", "title" => "Detail Entreprise"]);
        }else{
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherMAJEntreprise(){
        if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["numSiret"] || ConnexionUtilisateur::estSecretariat()){
            $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
            if($entreprise != null){
                self::afficherVue("FormulaireMiseAJour/vueMiseAJourEntreprise.php", ["entreprise"=>$entreprise]);
            }else{
                self::afficherErreur("L'entreprise n'est pas enregistrée");
            }

        }else{
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJEntreprise(){
        if(isset($_POST["num_siret"])){
            $entrepriseAVerifier = (new EntrepriseRepository())->recupererParClePrimaire($_POST["num_siret"]);
            if(ConnexionUtilisateur::estSecretariat()){
                $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["activite"],$entrepriseAVerifier->getMdp());
                (new EntrepriseRepository())->mettreAJour($entreprise);
                self::afficherErreur("Les informations de l'entreprise ".$entreprise->getNomEntreprise()." ont bien été mis à jour");
            }else if(ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["num_siret"]){
                if(isset($_POST["mdp"])){
                    $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $entrepriseAVerifier->getMdp());
                    if(!$mdpCorrect){
                        self::afficherErreur("Mot de passe Incorrect");
                    }else{
                        $entreprise = Entreprise::construireDepuisFormulaire($_POST);
                        (new EntrepriseRepository())->mettreAJour($entreprise);
                        self::afficherErreur("Les informations de votre entreprise ".$entreprise->getNomEntreprise()." ont bien été mis à jour");
                    }
                }else{
                    self::afficherErreur("Veuillez rentrer votre mot de passe");
                }

            }else{
                self::afficherErreur("Vous n'avez pas les droits");
            }
        }
        self::afficherAccueil();
    }

}