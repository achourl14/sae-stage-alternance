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
    }
    public static function consulterOffre() {

        $offresDeStage = (new OffredeStageRepository())->recuperer();
        foreach($offresDeStage as $offreFormatTableau){
            $tableauStage[] = $offreFormatTableau;
        }

        $offresAlternance = (new OffreAlternanceRepository())->recuperer();
        foreach($offresAlternance as $offreFormatTableau){
            $tableauAlternance[] = $offreFormatTableau;
        }

        self::afficherVue("vueGenerale.php", ["contenu" => "vueOffres.php", "offresStage" => $tableauStage, "offresAlternance" => $tableauAlternance,"title" => "Liste des offres"]);
    }

    public static function creerOffre(){
        //var_dump($_POST['offre']);

        $offre = $_POST['offre'];

        if ( $offre == 1){
            $offreStage = new OffredeStage($_POST["nomOffre"],$_POST["Entreprise"] ,$_POST["mission"] ,-9,-9,-9,0);
            OffredeStageRepository::sauvegarder($offreStage);
        }
        else{
            $offreAlternance = new OffreAlternance($_POST["nomOffre"],$_POST["Entreprise"], $_POST["mission"],-9,-9,-9,0);
            OffreAlternanceRepository::sauvegarder($offreAlternance);
        }
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
}

?>