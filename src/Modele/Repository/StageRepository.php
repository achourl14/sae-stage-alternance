<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;
use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Stage;
use DateTime;

class StageRepository extends AbstractRepository
{
    public static function sauvegarder(Stage $stage) : void {
        $sql = "INSERT INTO Stage VALUES(:numEtudiantTag, :numStageTag, :numMaitreStageTag, :idTuteurStageTag, :dateDebutStageTag, :dateFinStageTag, :remunerationTag, :numSIRETTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numEtudiantTag" => $stage->getIdEtudiantStage(),
            "numStageTag" => $stage->getNumStage(),
            "numMaitreStageTag" => $stage->getNumMaitreStage(),
            "idTuteurStageTag" => $stage->getIdTuteurStage(),
            "dateDebutStageTag" => $stage->getDateDebutStage(),
            "dateFinStageTag" => $stage->getDateFinStage(),
            "remunerationTag" => $stage->getRemuneration(),
            "numSIRETTag" => $stage->getNumSIRET()
        );

        $pdoStatement->execute($values);
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
        return array();
    }

    // si utiliser reprendre la fonction entière
    public function construireDepuisTableau(array $stageFormatSecretariat) : Stage {
        $stage = new Stage($stageFormatSecretariat['codeINE'],$stageFormatSecretariat['codeEtudiant'],$stageFormatSecretariat['promotion'],$stageFormatSecretariat['groupe'],$stageFormatSecretariat['nomEtudiant'],$stageFormatSecretariat['prenomEtudiant'],$stageFormatSecretariat['mailEtudiant'],$stageFormatSecretariat['telephoneEtudiant']);
        return $stage;
    }
}