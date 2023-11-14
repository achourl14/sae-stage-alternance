<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;
use App\Modele\DataObject\TuteurStage;

class TuteurStageRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "Professeur";
    }

    protected function getNomsColones(): array
    {
        return ["idProfesseur", "prenomProfesseur", "nomProfesseur", "mailProfesseur", "telephoneProfesseur"];
    }

    protected function getNomClePrimaire(): string
    {
        return "idProfesseur";
    }

    protected function construireDepuisTableau(array $objetFormatTableau): TuteurStage
    {
        return new TuteurStage(
            $objetFormatTableau["idProfesseur"],
            $objetFormatTableau["prenomProfesseur"],
            $objetFormatTableau["nomProfesseur"],
            $objetFormatTableau["mailProfesseur"],
            $objetFormatTableau["telephoneProfesseur"]
        );
    }
}