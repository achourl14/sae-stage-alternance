<?php

namespace Modele;

use App\Modele\ConnexionBaseDeDonnee;

class StageExterneEtudiants
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

    public function sauvegarder() : void {
        $sql = "INSERT INTO Stage VALUES(:numEtudiantTag, :numStageTag, :numMaitreStageTag, :idTuteurStageTag, :dateDebutStageTag, :dateFinStageTag, :remunerationTag, :numSIRETTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numEtudiantTag" => $this->idEtudiantStage,
            "numStageTag" => $this->numStage,
            "numMaitreStageTag" => $this->numMaitreStage,
            "idTuteurStageTag" => $this->idTuteurStage,
            "dateDebutStageTag" => $this->dateDebutStage,
            "dateFinStageTag" => $this->dateFinStage,
            "remunerationTag" => $this->remuneration,
            "numSIRETTag" => $this->numSIRET,
        );

        $pdoStatement->execute($values);
    }
}