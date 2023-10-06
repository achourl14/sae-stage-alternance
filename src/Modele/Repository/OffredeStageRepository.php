<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\OffredeStage;

class OffredeStageRepository
{
    public static function construireDepuisTableau(array $offreFormatTableau) : OffredeStage {
        $offreDeStage = new OffredeStage($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseStage'],$offreFormatTableau['missionStage'],$offreFormatTableau['statueStage'],$offreFormatTableau['idStage'],$offreFormatTableau['ValidationStage'],1);
        return $offreDeStage;
    }

    public static function getOffreDeStage(){
        $pdoStatement =  ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM OffreDeStage");
        foreach($pdoStatement as $offreFormatTableau){
            $tableau[] = self::construireDepuisTableau($offreFormatTableau);
        }
        return $tableau;
    }

    public static function sauvegarder($offre) : void {

        $sql = "INSERT INTO OffreDeStage (idEntrepriseStage, missionStage, nomOffre) VALUES (:idEntrepriseTag, :missionTag, :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $offre->idEntreprise,
            "missionTag" => $offre->mission,
            "nomOffreTag" => $offre->nomOffre
        );
        $pdoStatement->execute($values);
    }
}