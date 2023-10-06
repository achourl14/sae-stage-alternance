<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\OffreAlternance;

class OffreAlternanceRepository
{
    public static function construireDepuisTableau(array $offreFormatTableau) : OffreAlternance {
        $offreDeStage = new OffreAlternance($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseAlternance'],$offreFormatTableau['missionAlternance'],$offreFormatTableau['statueAlternance'],$offreFormatTableau['idAlternance'],$offreFormatTableau['ValidationAlternance'],1);
        return $offreDeStage;
    }

    public static function getOffreAlternance(){
        $pdoStatement =  ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM OffreDeAlternance");
        foreach($pdoStatement as $offreFormatTableau){
            $tableau[] = self::construireDepuisTableau($offreFormatTableau);
        }
        return $tableau;
    }

    public static function sauvegarder($offre) : void {

        $sql = "INSERT INTO OffreDeAlternance (idEntrepriseAlternance, missionAlternance, nomOffre) VALUES(:idEntrepriseTag, :missionTag, :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $offre->idEntreprise,
            "missionTag" => $offre->mission,
            "nomOffreTag" => $offre->nomOffre
        );
        $pdoStatement->execute($values);
    }
}