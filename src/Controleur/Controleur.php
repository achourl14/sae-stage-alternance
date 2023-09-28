<?php
require_once "../Modele/Entreprise.php";
require_once "../Modele/ConnexionBaseDeDonnee.php";
class Controleur {
    public static function creerEntreprise() : void {
        $entreprise = new Entreprise($_POST["num_siret"],$_POST["nom_entreprise"],$_POST["adresse"],$_POST["telephone"],$_POST["mail"],$_POST["interlocuteur"],$_POST["code_ape"],$_POST["code_ape"],$_POST["mdp"]);
        $entreprise->sauvegarder();
    }
    public static function consulterOffreStage() {
        $sql = "select * from offreDeStage";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $offres = array();

        $pdoStatement->execute($offres);



        require ("../Vue/VueOffreS.php");
    }

    public static function consulterOffreAlternance() {
        $sql = "select * from offreDeAlternance";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        $offres = array();

        $pdoStatement->execute($offres);


        require ("../Vue/VueOffreA.php");
    }
}

?>