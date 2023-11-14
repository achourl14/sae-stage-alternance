<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\ConnexionBaseDeDonnee;
use DateTime;

class Alternance extends AbstractDataObject
{
    private string $idEtudiantAlternant;

    private int $numOffreAltrenance;

    private int $numMaitreAlternance;

    private int $idTuteurAlternance;

    private string $dateDebutAlternance;
    private string $dateFinAlternance;

    private float $remuneration;

    private string $numSiretEntrepriseExterieur;

    /**
     * @param string $idEtudiantAlternant
     * @param int $numOffreAltrenance
     * @param int $numMaitreAlternance
     * @param int $idTuteurAlternance
     * @param string $dateDebutAlternance
     * @param string $dateFinAlternance
     * @param float $remuneration
     * @param string $numSiretEntrepriseExterieur
     */
    public function __construct(string $idEtudiantAlternant, int $numOffreAltrenance, int $numMaitreAlternance, int $idTuteurAlternance, string $dateDebutAlternance, string $dateFinAlternance, float $remuneration, string $numSiretEntrepriseExterieur)
    {
        $this->idEtudiantAlternant = $idEtudiantAlternant;
        $this->numOffreAltrenance = $numOffreAltrenance;
        $this->numMaitreAlternance = $numMaitreAlternance;
        $this->idTuteurAlternance = $idTuteurAlternance;
        $this->dateDebutAlternance = $dateDebutAlternance;
        $this->dateFinAlternance = $dateFinAlternance;
        $this->remuneration = $remuneration;
        $this->numSiretEntrepriseExterieur = $numSiretEntrepriseExterieur;
    }

    public function getIdEtudiantAlternant(): string
    {
        return $this->idEtudiantAlternant;
    }

    public function getNumOffreAltrenance(): int
    {
        return $this->numOffreAltrenance;
    }

    public function getNumMaitreAlternance(): int
    {
        return $this->numMaitreAlternance;
    }

    public function getIdTuteurAlternance(): int
    {
        return $this->idTuteurAlternance;
    }

    public function getDateDebutAlternance(): string
    {
        return $this->dateDebutAlternance;
    }

    public function getDateFinAlternance(): string
    {
        return $this->dateFinAlternance;
    }

    public function getRemuneration(): float
    {
        return $this->remuneration;
    }

    public function getNumSiretEntrepriseExterieur(): string
    {
        return $this->numSiretEntrepriseExterieur;
    }

    public function formatTableau(): array
    {
        return array(
            "idEtudiantAlternantTag" => $this->idEtudiantAlternant,
            "numOffreAlternanceTag" => $this->numOffreAltrenance,
            "numMaitreDeAlternanceTag" => $this->numMaitreAlternance,
            "idTuteurAlternanceTag" => $this->idTuteurAlternance,
            "dateDebutAlternanceTag" => $this->dateDebutAlternance,
            "dateFinAlternanceTag" => $this->dateFinAlternance,
            "remunerationTag" => $this->remuneration,
            "numSiretEntrepriseAlternanceExterieurTag" => $this->numSiretEntrepriseExterieur
        );
    }
}