<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\OffredeStage;

class OffredeStageRepository extends AbstractRepository
{
    public function construireDepuisTableau(array $offreFormatTableau) : OffredeStage {
        $offreDeStage = new OffredeStage($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseStage'],$offreFormatTableau['missionStage'],$offreFormatTableau['statueStage'],$offreFormatTableau['idStage'],$offreFormatTableau['Validation'],1);
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

    public function recupererOffreStageValide()
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM OffreDeStage WHERE Validation = 1");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public static function validerOffreDeStage(OffredeStage $offreDeStage) : void {

        $sql = "UPDATE OffreDeStage SET Validation = :ValidationTag WHERE idStage = :idStageTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);


        if ($offreDeStage->getValidation() == 0) {
               $values = array(
                     "ValidationTag" => 1,
                     "idStageTag" => $offreDeStage->getIdStage(),
               );
               $pdoStatement->execute($values);
        }
        else{
                $values = array(
                    "ValidationTag" => 0,
                    "idStageTag" => $offreDeStage->getIdStage(),
                );
                $pdoStatement->execute($values);
        }
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