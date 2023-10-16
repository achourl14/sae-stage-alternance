<?php
namespace App\Controleur;
use App\Modele\DataObject\Entreprise;
use App\Modele\DataObject\OffreAlternance;
use App\Modele\DataObject\OffredeStage;
use App\Modele\Repository\AbstractRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\OffreAlternanceRepository;
use App\Modele\Repository\OffredeStageRepository;

class Controleur {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require ("../src/Vue/$cheminVue"); // Charge la vue
    }

    public static function creerEntreprise() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        EntrepriseRepository::sauvegarder($entreprise);
        echo '<div class="msgConfirmation"><p> Vous avez bien inscrit votre entreprise du nom de : '.$_POST["nom_entreprise"].'</p></div>';
        self::afficherAccueil();
    }
    public static function consulterOffre()
    {

        $offresDeStage = (new OffredeStageRepository())->recupererOffreStageValide();
        $offresAlternance = (new OffreAlternanceRepository())->recupererOffreAlternanceValide();

        $tableauStage = null;
        $tableauAlternance = null;

        if($offresDeStage == null & $offresAlternance == null){
            self::afficherAucuneOffre();
        }else{
            if($offresDeStage != null){
                foreach ($offresDeStage as $offreFormatTableau) {
                    $tableauStage[] = $offreFormatTableau;
                }
            }
            if($offresAlternance != null){
                foreach ($offresAlternance as $offreFormatTableau) {
                    $tableauAlternance[] = $offreFormatTableau;
                }
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "vueOffres.php", "offresStage" => $tableauStage, "offresAlternance" => $tableauAlternance, "title" => "Liste des offres", "contenuDetail" => "vueDetail.php"]);
        }
    }

    public static function consulterOffreSecretaire() {

        $offresDeStage = (new OffredeStageRepository())->recuperer();
        $offresAlternance = (new OffreAlternanceRepository())->recuperer();

        $tableauStage = null;
        $tableauAlternance = null;

        if($offresDeStage == null & $offresAlternance == null){
            self::afficherAucuneOffre();
        }else{
            if($offresDeStage != null){
                foreach ($offresDeStage as $offreFormatTableau) {
                    $tableauStage[] = $offreFormatTableau;
                }
            }
            if($offresAlternance != null){
                foreach ($offresAlternance as $offreFormatTableau) {
                    $tableauAlternance[] = $offreFormatTableau;
                }
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "vueValiderOffre.php", "offresStage" => $tableauStage, "offresAlternance" => $tableauAlternance, "title" => "Liste des offres à valider", "contenuDetail" => "vueDetail.php"]);
        }
    }

    public static function validerOffreAlternance(){
        $offre = (new OffreAlternanceRepository())->recupererParClePrimaire($_GET['id']);
        OffreAlternanceRepository::validerOffreDeAlternance($offre);
        $msg = "";
        if($offre->getValidation()){
            $msg = "invalider";
        }else{
            $msg = "valider";
        }
        echo '<div class="msgConfirmation"><p> Vous avez bien '.$msg.' l\'offre d\'Alternance : '.$offre->getNomOffre().'</p></div>';
        self::consulterOffreSecretaire();
    }

    public static function validerOffreStage(){
        $offre = (new OffredeStageRepository())->recupererParClePrimaire($_GET['id']);
        OffredeStageRepository::validerOffreDeStage($offre);
        $msg = "";
        if($offre->getValidation()){
            $msg = "invalider";
        }else{
            $msg = "valider";
        }
        echo '<div class="msgConfirmation"><p> Vous avez bien '.$msg.' l\'offre de Stage : '.$offre->getNomOffre().'</p></div>';
        self::consulterOffreSecretaire();
    }

    public static function creerOffre(){
        $type = $_POST['offre'];
        $offre = null;
        $msg = "";
        if ( $type == 1){
            $offre = new OffredeStage($_POST["nomOffre"],$_POST["Entreprise"] ,$_POST["mission"] ,-9,-9,-9,0);
            OffredeStageRepository::sauvegarder($offre);
            $msg = "de Stage";
        }
        else{
            $offre = new OffreAlternance($_POST["nomOffre"],$_POST["Entreprise"], $_POST["mission"],-9,-9,-9,0);
            OffreAlternanceRepository::sauvegarder($offre);
            $msg = "d'Alternance";
        }
        echo '<div class="msgConfirmation"><p> Vous avez bien valider l\'offre '.$msg.' : '.$offre->getNomOffre().'</p></div>';
        self::consulterOffre();
    }

    public static function afficherAccueil(){
        self::afficherVue("vueGenerale.php",["contenu" => "index.html","title" => "Accueil"]);
    }

    public static function afficherInscription(){
        self::afficherVue("inscription.html");
    }

    public static function afficherFormulaire(){
        self::afficherVue("vueGenerale.php",["contenu" => "formulaireoffre.html","title" => "Création Offres"]);
    }

    public static function afficherConnexion(){
        self::afficherVue("connexion.html");
    }

    public static function afficherAucuneOffre(){
        self::afficherVue("vueGenerale.php",["title" => "Indisponible", "contenu" => "vueAucuneOffres.php"]);
    }

    public static function afficherDetail(){
        self::afficherVue("vueGenerale.php", ["title" => "Detail offre", "contenu" => "vueDetail.php"]);
    }
}

?>