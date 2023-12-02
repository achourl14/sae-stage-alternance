<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\ConnexionBaseDeDonnee;
use DateTime;

class Alternance extends AbstractDataObject
{
    private string $loginEtuAlternance;
    private int $idOffreAlternance;

    /**
     * @param string $loginEtuAlternance
     * @param int $idOffre
     */
    public function __construct(string $loginEtuAlternance, int $idOffreAlternance)
    {
        $this->loginEtuAlternance = $loginEtuAlternance;
        $this->idOffreAlternance = $idOffreAlternance;
    }

    public function getLoginEtuAlternance(): string
    {
        return $this->loginEtuAlternance;
    }

    public function getIdOffreAlternance(): int
    {
        return $this->idOffreAlternance;
    }




    public function formatTableau(): array
    {
        return array(
            "loginEtuAlternanceTag" => $this->getLoginEtuAlternance(),
            "idOffreAlternanceTag" => $this->getIdOffreAlternance()
        );
    }
}