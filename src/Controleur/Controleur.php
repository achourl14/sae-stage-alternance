<?php
namespace App\Controleur;
use App\Modele\AlternanceExterneEtudiants;
use App\Modele\Entreprise;
use Modele\StageExterneEtudiants;

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
    public static function creerStageExterne() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        $entreprise->sauvegarder();
        /*
        a changer

        $alternanceStageEtudiant = new StageExterneEtudiants($_POST["idEtudiantAlternant"], $_POST["numOffreAltrenance"], $_POST["numMaitreAlternance"], $_POST["idTuteurAlternance"], $_POST["dateDebutAlternance"], $_POST["dateFinAlternance"], $_POST["remuneration"], $_POST["numSiretEntrepriseExterieur"]);
        $alternanceStageEtudiant -> sauvegarder();
        */
}

    public static function creerAlternanceExterne() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        $entreprise->sauvegarder();
        $alternanceExterneEtudiant = new AlternanceExterneEtudiants($_POST["idEtudiantAlternant"], $_POST["numOffreAltrenance"], $_POST["numMaitreAlternance"], $_POST["idTuteurAlternance"], $_POST["dateDebutAlternance"], $_POST["dateFinAlternance"], $_POST["remuneration"], $_POST["numSiretEntrepriseExterieur"]);
        $alternanceExterneEtudiant -> sauvegarder();
    }
}

?>