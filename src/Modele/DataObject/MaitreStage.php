<?php

namespace App\Modele\DataObject;

class MaitreStage extends AbstractDataObject
{
    private int $idMaiteDeStage;
    private string $nom;
    private string $prenom;
    private string $mailMaitreDeStage;
    private string $telephoneMaitreDeStage;

    /**
     * @param int $idMaiteDeStage
     * @param string $nom
     * @param string $prenom
     * @param string $mailMaitreDeStage
     * @param string $telephoneMaitreDeStage
     */
    public function __construct(int $idMaiteDeStage, string $prenom, string $nom,string $mailMaitreDeStage, string $telephoneMaitreDeStage)
    {
        $this->idMaiteDeStage = $idMaiteDeStage;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mailMaitreDeStage = $mailMaitreDeStage;
        $this->telephoneMaitreDeStage = $telephoneMaitreDeStage;
    }

    public function getIdMaiteDeStage(): int
    {
        return $this->idMaiteDeStage;
    }

    public function setIdMaiteDeStage(int $idMaiteDeStage): void
    {
        $this->idMaiteDeStage = $idMaiteDeStage;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getMailMaitreDeStage(): string
    {
        return $this->mailMaitreDeStage;
    }

    public function setMailMaitreDeStage(string $mailMaitreDeStage): void
    {
        $this->mailMaitreDeStage = $mailMaitreDeStage;
    }

    public function getTelephoneMaitreDeStage(): string
    {
        return $this->telephoneMaitreDeStage;
    }

    public function setTelephoneMaitreDeStage(string $telephoneMaitreDeStage): void
    {
        $this->telephoneMaitreDeStage = $telephoneMaitreDeStage;
    }

    public function formatTableau(): array
    {
        return array(
            "idMaiteDeStageTag" => $this->getIdMaiteDeStage(),
            "nomTag" => $this->getNom(),
            "prenomTag" => $this->getPrenom(),
            "mailMaitreDeStageTag" => $this->getMailMaitreDeStage(),
            "telephoneMaitreDeStageTag" => $this->getTelephoneMaitreDeStage()
        );
    }

    public static function construireDepuisTableau(array $objetFormatTableau) : MaitreStage
    {
        return new MaitreStage(
            $objetFormatTableau["idMaiteDeStage"],
            $objetFormatTableau["nom"],
            $objetFormatTableau["prenom"],
            $objetFormatTableau["mailMaitreDeStage"],
            $objetFormatTableau["telephoneMaitreDeStage"]
        );
    }

    public function __toString(): string
    {
        return "MaitreStage : " . $this->getIdMaiteDeStage() . "<br>" . $this->getNom() . " <br>" . $this->getPrenom() . " <br>" . $this->getMailMaitreDeStage() . " <br>" . $this->getTelephoneMaitreDeStage() . "<br>";
    }

}