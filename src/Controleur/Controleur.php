<?php
namespace App\Controleur;
use App\Modele\Entreprise;
class Controleur {
    public static function creerEntreprise() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        $entreprise->sauvegarder();
    }
}

?>