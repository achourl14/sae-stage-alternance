<?php

namespace App\Modele\Repository;

use App\Controleur\Controleur;
use App\Modele\DataObject\OffreAlternance;

class OffreAlternanceRepository extends AbstractRepository
{
    public function construireDepuisTableau(array $offreFormatTableau) : OffreAlternance {
        $offreDeStage = new OffreAlternance($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseAlternance'],$offreFormatTableau['missionAlternance'],$offreFormatTableau['statueAlternance'],$offreFormatTableau['idAlternance'],$offreFormatTableau['Validation'],1);
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

    public function recupererOffreAlternanceValide()
    {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM OffreDeAlternance WHERE Validation = 1");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public static function validerOffreDeAlternance(int $idAlternance) : void {

        $sql = "UPDATE OffreDeAlternance SET Validation = :ValidationTag WHERE idAlternance = :idAlternanceTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $offredeAlternance = (new OffreAlternanceRepository())->recupererParClePrimaire($idAlternance);

        if ($offredeAlternance->getValidation() == 0) {
              $values = array(
              "ValidationTag" => 1,
              "idAlternanceTag" => $idAlternance,
              );
              $pdoStatement->execute($values);
        }
        else{
              $values = array(
                  "ValidationTag" => 0,
                  "idAlternanceTag" => $idAlternance,
              );
              $pdoStatement->execute($values);
        }
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