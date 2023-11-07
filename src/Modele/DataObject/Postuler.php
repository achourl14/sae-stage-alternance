<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\AbstractRepository;

class Postuler extends AbstractDataObject
{
    private string $codeINE;
    private int $idOffre;

    /**
     * @param string $codeINE
     * @param int $idOffre
     */
    public function __construct(string $codeINE, int $idOffre)
    {
        $this->codeINE = $codeINE;
        $this->idOffre = $idOffre;
    }

    public function getCodeINE(): string
    {
        return $this->codeINE;
    }

    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    public function formatTableau(): array
    {
        return array(
            "codeINETag" => $this->getCodeINE(),
            "idOffreTag" => $this->getIdOffre()
        );
    }


}