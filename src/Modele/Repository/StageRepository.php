<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;
use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Postuler;
use App\Modele\DataObject\Stage;
use DateTime;

class StageRepository extends AbstractRepository
{
    public static function sauvegarder(Stage $stage) : void {
        $sql = "INSERT INTO Stage VALUES(:loginEtuStageTag, :idOffreStageTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuStageTag" => $stage->getLoginEtuStage(),
            "idOffreStageTag" => $stage->getIdOffreStage(),
        );

        $pdoStatement->execute($values);
    }

    public function recupererDepuisClePrimaire(string $loginEtuStage, string $idOffreStage): ?Stage{
        $sql = "SELECT * from ".$this->getNomTable()." WHERE idOffreStage = :idOffreStageTag AND loginEtuStage = :loginEtuStageTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idOffreStageTag" => $idOffreStage,
            "loginEtuStageTag" => $loginEtuStage
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de objet correspondante
        $objetFormatTableau = $pdoStatement->fetch();
        if($objetFormatTableau == null){
            return null;
        }
        return $this->construireDepuisTableau($objetFormatTableau);
    }

    public function recupererParEtudiant(string $loginEtuStage)
    {
        $sql = "SELECT * from " . $this->getNomTable() . " WHERE loginEtuStage = :loginEtuStageTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuStageTag" => $loginEtuStage
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        return $this->construireDepuisTableau($pdoStatement->fetch());
    }

    protected function getNomClePrimaire(): string
    {
        return "peutpas";
    }

    protected function getNomTable(): string
    {
        return "Stage";
    }

    protected function getNomsColones(): array
    {
        return array("loginEtuStage",
        "idOffreStage");
    }

    // si utiliser reprendre la fonction entière
    public function construireDepuisTableau(array $stageFormatSecretariat) : Stage {
        $stage = new Stage($stageFormatSecretariat['loginEtuStage'],$stageFormatSecretariat['idOffreStage']);
        return $stage;
    }
}