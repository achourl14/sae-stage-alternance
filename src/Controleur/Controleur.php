<?php
namespace App\Controleur;
use App\Modele\DataObject\Entreprise;
use App\Modele\DataObject\OffreAlternance;
use App\Modele\DataObject\OffredeStage;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\OffreAlternanceRepository;
use App\Modele\Repository\OffredeStageRepository;

class Controleur {

    private static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require ("../src/Vue/$cheminVue"); // Charge la vue
    }

    public static function creerEntreprise() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["activite"],$_POST["mdp"]);
        $entreprise->sauvegarder();
    }

    // creer un offre de Stage ou d'Alternance
    /*
    Offre Alternance => table offre_alternance
    Offre de stage => table offre_stage
    */
    public static function creerStageExterne() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["activite"],$_POST["mdp"]);
        $entreprise->sauvegarder();

        $alternanceStageEtudiant = new StageExterneEtudiants($_POST["idEtudiantStage"], $_POST["numStage"], $_POST["numMaitreStage"], $_POST["idTuteurStage"], $_POST["dateDebutStage"], $_POST["dateFinStage"], $_POST["remuneration"], $_POST["numSIRET"]);
        $alternanceStageEtudiant -> sauvegarder();

}

    public static function creerAlternanceExterne() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["activite"],$_POST["mdp"]);
        $entreprise->sauvegarder();
        $alternanceExterneEtudiant = new AlternanceExterneEtudiants($_POST["idEtudiantAlternant"], $_POST["numOffreAltrenance"], $_POST["numMaitreAlternance"], $_POST["idTuteurAlternance"], $_POST["dateDebutAlternance"], $_POST["dateFinAlternance"], $_POST["remuneration"], $_POST["numSiretEntrepriseExterieur"]);
        $alternanceExterneEtudiant -> sauvegarder();
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
    }

    public static function afficherAccueil(){
        self::afficherVue("index.html");
    }

    public static function afficherInscription(){
        self::afficherVue("inscription.html");
    }

    public static function afficherFormulaire(){
        self::afficherVue("formulaireoffre.html");
    }

    public static function afficherConnexion(){
        self::afficherVue("connexion.html");
    }
}

?>