<?php
namespace App\Controleur;
use App\Modele\Entreprise;
use App\Modele\ConnexionBaseDeDonnee;
use App\Modele\OffredeStage;
use App\Modele\OffreAlternance;

class Controleur {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require ("../src/Vue/$cheminVue"); // Charge la vue
    }

    public static function creerEntreprise() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        $entreprise->sauvegarder();
    }
    public static function consulterOffre() {
//       $sql = "select * from offreDeStage";
//       $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
//       $offres = array();
//
//        $pdoStatement->execute($offres);

        $offresDeStage = OffredeStage::getOffreDeStage();
        foreach($offresDeStage as $offreFormatTableau){
            $tableauStage[] = $offreFormatTableau;
        }

        $offresAlternance = OffreAlternance::getOffreAlternance();
        foreach($offresAlternance as $offreFormatTableau){
            $tableauAlternance[] = $offreFormatTableau;
        }

        self::afficherVue("vueGenerale.php", ["contenu" => "vueOffres.php", "offresStage" => $tableauStage, "offresAlternance" => $tableauAlternance,"title" => "Liste des offres"]);
    }

    public static function creerOffre(){
        //var_dump($_POST['offre']);

        $offre = $_POST['offre'];

        if ( $offre == 1){
            $offreStage = new OffreStage($_POST["Entreprise"],$_POST["mission"], $_POST["nomOffre"]);
            $offreStage->OffreStage::sauvegarder();
        }
        else{
            $offreAlternance = new OffreAlternance($_POST["Entreprise"],$_POST["mission"], $_POST["nomOffre"]);
            $offreAlternance->OffreAlternance::sauvegarder();
        }
    }
}

?>