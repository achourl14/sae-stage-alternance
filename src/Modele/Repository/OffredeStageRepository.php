<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\OffredeStage;

class OffredeStageRepository extends AbstractRepository
{
    public function construireDepuisTableau(array $offreFormatTableau) : OffredeStage {
        $offreDeStage = new OffredeStage($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseStage'],$offreFormatTableau['missionStage'],$offreFormatTableau['statueStage'],$offreFormatTableau['idStage'],$offreFormatTableau['ValidationStage'],1);
        return $offreDeStage;
    }

    public static function sauvegarder(OffredeStage $offre) : void {

        $sql = "INSERT INTO OffreDeStage (idEntrepriseStage, missionStage, nomOffre) VALUES (:idEntrepriseTag, :missionTag, :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $offre->getIdEntreprise(),
            "missionTag" => $offre->getMission(),
            "nomOffreTag" => $offre->getNomOffre()
        );
        $pdoStatement->execute($values);
    }

    protected function getNomsColones(): array
    {
        return array(
            "nomOffre",
            "idEntrepriseAlternance",
            "missionAlternance",
            "statueAlternance",
            "ValidationAlternance"
        );
    }

    protected function getNomTable(): string
    {
        return "OffreDeStage";
    }

    protected function getNomClePrimaire(): string
    {
        return "idStage";
    }
}