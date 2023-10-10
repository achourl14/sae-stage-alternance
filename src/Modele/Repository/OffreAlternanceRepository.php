<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\OffreAlternance;

class OffreAlternanceRepository extends AbstractRepository
{
    public function construireDepuisTableau(array $offreFormatTableau) : OffreAlternance {
        $offreDeStage = new OffreAlternance($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseAlternance'],$offreFormatTableau['missionAlternance'],$offreFormatTableau['statueAlternance'],$offreFormatTableau['idAlternance'],$offreFormatTableau['ValidationAlternance'],1);
        return $offreDeStage;
    }

    public static function sauvegarder(OffreAlternance $offre) : void {

        $sql = "INSERT INTO OffreDeAlternance (idEntrepriseAlternance, missionAlternance, nomOffre) VALUES(:idEntrepriseTag, :missionTag, :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $offre->getIdEntreprise(),
            "missionTag" => $offre->getMission(),
            "nomOffreTag" => $offre->getNomOffre()
        );
        $pdoStatement->execute($values);
    }
    protected function getNomTable(): string
    {
        return "OffreDeAlternance";
    }

    protected function getNomClePrimaire(): string
    {
        return "idAlternance";
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

}