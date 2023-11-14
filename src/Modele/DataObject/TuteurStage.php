<?php

namespace App\Modele\DataObject;

class TuteurStage extends AbstractDataObject
{
    private int $idProfesseur;

    private string $prenomProfesseur;
    private string $nomProfesseur;
    private string $mailProfesseur;
    private string $telephoneProfesseur;

    /**
     * @param int $idProfesseur
     * @param string $prenomProfesseur
     * @param string $nomProfesseur
     * @param string $mailProfesseur
     * @param string $telephoneProfesseur
     */
    public function __construct(int $idProfesseur, string $prenomProfesseur, string $nomProfesseur, string $mailProfesseur, string $telephoneProfesseur)
    {
        $this->idProfesseur = $idProfesseur;
        $this->prenomProfesseur = $prenomProfesseur;
        $this->nomProfesseur = $nomProfesseur;
        $this->mailProfesseur = $mailProfesseur;
        $this->telephoneProfesseur = $telephoneProfesseur;
    }

    public function getIdProfesseur(): int
    {
        return $this->idProfesseur;
    }

    public function setIdProfesseur(int $idProfesseur): void
    {
        $this->idProfesseur = $idProfesseur;
    }

    public function getPrenomProfesseur(): string
    {
        return $this->prenomProfesseur;
    }

    public function setPrenomProfesseur(string $prenomProfesseur): void
    {
        $this->prenomProfesseur = $prenomProfesseur;
    }

    public function getNomProfesseur(): string
    {
        return $this->nomProfesseur;
    }

    public function setNomProfesseur(string $nomProfesseur): void
    {
        $this->nomProfesseur = $nomProfesseur;
    }

    public function getMailProfesseur(): string
    {
        return $this->mailProfesseur;
    }

    public function setMailProfesseur(string $mailProfesseur): void
    {
        $this->mailProfesseur = $mailProfesseur;
    }

    public function getTelephoneProfesseur(): string
    {
        return $this->telephoneProfesseur;
    }

    public function setTelephoneProfesseur(string $telephoneProfesseur): void
    {
        $this->telephoneProfesseur = $telephoneProfesseur;
    }

    public function __toString(): string
    {
        return "TuteurStage : idProfesseur = " . $this->idProfesseur . ", prenomProfesseur = " . $this->prenomProfesseur . ", nomProfesseur = " . $this->nomProfesseur . ", mailProfesseur = " . $this->mailProfesseur . ", telephoneProfesseur = " . $this->telephoneProfesseur . ".";

    }

    public function formatTableau(): array
    {
        return array(
            "idProfesseur" => $this->idProfesseur,
            "prenomProfesseur" => $this->prenomProfesseur,
            "nomProfesseur" => $this->nomProfesseur,
            "mailProfesseur" => $this->mailProfesseur,
            "telephoneProfesseur" => $this->telephoneProfesseur
        );
    }
}