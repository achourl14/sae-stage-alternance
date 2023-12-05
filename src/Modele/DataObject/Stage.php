<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\ConnexionBaseDeDonnee;
use DateTime;

class Stage extends AbstractDataObject
{
    private $loginEtuStage;
    private $idOffreStage;

    /**
     * @param $idEtudiantStage
     * @param $numStage
     */
    public function __construct($loginEtuStage, $idOffreStage)
    {
        $this->loginEtuStage = $loginEtuStage;
        $this->idOffreStage = $idOffreStage;
    }

    /**
     * @return mixed
     */
    public function getLoginEtuStage()
    {
        return $this->loginEtuStage;
    }

    /**
     * @return mixed
     */
    public function getIdOffreStage() : int
    {
        return $this->idOffreStage;
    }


    public function formatTableau(): array
    {
        return array(
            "loginEtuStageTag" => $this->getLoginEtuStage(),
            "idOffreStageTag" => $this->getIdOffreStage()
        );
    }
}