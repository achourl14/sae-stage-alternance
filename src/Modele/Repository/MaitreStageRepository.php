<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;
use App\Modele\DataObject\Etudiant;
use App\Modele\DataObject\MaitreStage;

class MaitreStageRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "MaitreDeStage";
    }

    protected function getNomsColones(): array
    {
        return array("idMaitreDeStage","prenomMaitreDeStage","nomMaitreDeStage","mailMaitreDeStage", "telephoneMaitreDeStage");
    }

    protected function getNomClePrimaire(): string
    {
        return "idMaitreDeStage";
    }

    public function construireDepuisTableau(array $maitreDeStage) : MaitreStage
    {
        return new MaitreStage($maitreDeStage["idMaitreDeStage"], $maitreDeStage["prenomMaitreDeStage"], $maitreDeStage["nomMaitreDeStage"], $maitreDeStage["mailMaitreDeStage"], $maitreDeStage["telephoneMaitreDeStage"]);
    }
}