<?php
namespace App\Controleur;
use App\Modele\AlternanceExterneEtudiants;
use App\Modele\Entreprise;

class Controleur {
    public static function creerEntreprise() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        $entreprise->sauvegarder();
    }

    // creer un offre de Stage ou d'Alternance
    /*
    Offre Alternance => table offre_alternance
    Offre de stage => table offre_stage
    */
    public static function creerOffreEtudiantStage() : void {

}
    public static function creerOffreEtudiantAlternance() : void {
        $alternanceExterneEtudiant = new AlternanceExterneEtudiants($_POST["idEtudiantAlternant"], $_POST["numOffreAltrenance"], $_POST["numMaitreAlternance"], $_POST["idTuteurAlternance"], $_POST["dateDebutAlternance"], $_POST["dateFinAlternance"], $_POST["remuneration"], $_POST["numSiretEntrepriseExterieur"]);
        $alternanceExterneEtudiant -> sauvegarder();
    }
}

?>