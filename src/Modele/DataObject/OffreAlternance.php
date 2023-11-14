<?php

namespace App\Modele\DataObject;

class OffreAlternance extends AbstractDataObject
{
    private int $idAlternance;
    private string $nomOffre;
    private int $idEntreprise;
    private string $mission;
    private string $statutAlternance;
    private int $validation;

    /**
     * @param int $idAlternant
     * @param int $idEntreprise
     * @param string $mission
     * @param string $statutStage
     * @param int $validation
     */
    public function __construct(string $nomOffre,int $idEntreprise, string $mission, string $statutAlternance, int $idAlternance, int $validation,int $inOut){
        $this->nomOffre = $nomOffre;
        $this->idEntreprise = $idEntreprise;
        $this->mission = $mission;
        if($inOut == 1){
            self::construct2($idAlternance,$statutAlternance,$validation);
        }
    }

    public function construct2(int $idStage,string $statutStage, int $validation)
    {
        $this->idAlternance = $idStage;
        $this->statutAlternance = $statutStage;
        $this->validation = $validation;
    }

    public function getIdAlternance(): int
    {
        return $this->idAlternance;
    }

    public function getNomOffre(): string
    {
        return $this->nomOffre;
    }

    public function getIdEntreprise(): int
    {
        return $this->idEntreprise;
    }

    public function getMission(): string
    {
        return $this->mission;
    }

    public function getStatutAlternance(): string
    {
        return $this->statutAlternance;
    }

    public function getValidation(): int
    {
        return $this->validation;
    }

    public function formatTableau(): array
    {
        return array(
            "idAlternanceTag" => $this->getIdAlternance(),
            "idEntrepriseAlternanceTag" => $this->getIdEntreprise(),
            "missionAlternanceTag" => $this->getMission(),
            "statueAlternance" => $this->getStatutAlternance(),
            "ValidationAlternanceTag" => $this->getValidation(),
            "nomOffreTag" => $this->getNomOffre()
        );
    }


}