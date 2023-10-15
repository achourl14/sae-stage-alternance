<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\ConnexionBaseDeDonnee;

class Stage extends AbstractDataObject
{
    private $idEtudiantStage;
    private $numStage;
    private $numMaitreStage;
    private $idTuteurStage;
    private $dateDebutStage;
    private $dateFinStage;
    private $remuneration;
    private $numSIRET;

    /**
     * @param $idEtudiantStage
     * @param $numStage
     * @param $numMaitreStage
     * @param $idTuteurStage
     * @param $dateDebutStage
     * @param $dateFinStage
     * @param $remuneration
     * @param $numSIRET
     */
    public function __construct($idEtudiantStage, $numStage, $numMaitreStage, $idTuteurStage, $dateDebutStage, $dateFinStage, $remuneration, $numSIRET)
    {
        $this->idEtudiantStage = $idEtudiantStage;
        $this->numStage = $numStage;
        $this->numMaitreStage = $numMaitreStage;
        $this->idTuteurStage = $idTuteurStage;
        $this->dateDebutStage = $dateDebutStage;
        $this->dateFinStage = $dateFinStage;
        $this->remuneration = $remuneration;
        $this->numSIRET = $numSIRET;
    }

    /**
     * @return mixed
     */
    public function getIdEtudiantStage() : string
    {
        return $this->idEtudiantStage;
    }

    /**
     * @return mixed
     */
    public function getNumStage() : int
    {
        return $this->numStage;
    }

    /**
     * @return mixed
     */
    public function getNumMaitreStage() : int
    {
        return $this->numMaitreStage;
    }

    /**
     * @return mixed
     */
    public function getIdTuteurStage() : int
    {
        return $this->idTuteurStage;
    }

    /**
     * @return mixed
     */
    public function getDateDebutStage() : string
    {
        return $this->dateDebutStage;
    }

    /**
     * @return mixed
     */
    public function getDateFinStage() : string
    {
        return $this->dateFinStage;
    }

    /**
     * @return mixed
     */
    public function getRemuneration() : int
    {
        return $this->remuneration;
    }

    /**
     * @return mixed
     */
    public function getNumSIRET() : int
    {
        return $this->numSIRET;
    }



    public function formatTableau(): array
    {
        return array(
            "numEtudiantTag" => $this->idEtudiantStage,
            "numStageTag" => $this->numStage,
            "numMaitreStageTag" => $this->numMaitreStage,
            "idTuteurStageTag" => $this->idTuteurStage,
            "dateDebutStageTag" => $this->dateDebutStage,
            "dateFinStageTag" => $this->dateFinStage,
            "remunerationTag" => $this->remuneration,
            "numSIRETTag" => $this->numSIRET,
        );
    }
}