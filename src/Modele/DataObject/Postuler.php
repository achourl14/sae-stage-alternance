<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\AbstractRepository;

class Postuler extends AbstractDataObject
{
    private string $codeINE;
    private int $idOffre;

    private int $etat;

    /**
     * @param string $codeINE
     * @param int $idOffre
     */
    public function __construct(string $codeINE, int $idOffre,int $etat)
    {
        $this->codeINE = $codeINE;
        $this->idOffre = $idOffre;
        $this->etat = $etat;
    }

    public function getCodeINE(): string
    {
        return $this->codeINE;
    }

    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    public function getEtat(): int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): void
    {
        $this->etat = $etat;
    }


    public function formatTableau(): array
    {
        return array(
            "codeINETag" => $this->getCodeINE(),
            "idOffreTag" => $this->getIdOffre(),
            "etatTag" => $this->getEtat()
        );
    }


}