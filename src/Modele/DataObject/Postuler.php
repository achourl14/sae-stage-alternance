<?php

namespace App\Modele\DataObject;

use App\Modele\Repository\AbstractRepository;

class Postuler extends AbstractDataObject
{
    private string $loginEtu;
    private int $idOffre;

    private int $etat;

    /**
     * @param string $loginEtu
     * @param int $idOffre
     */
    public function __construct(string $loginEtu, int $idOffre,int $etat)
    {
        $this->loginEtu = $loginEtu;
        $this->idOffre = $idOffre;
        $this->etat = $etat;
    }

    public function getLoginEtu(): string
    {
        return $this->loginEtu;
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
            "loginEtuTag" => $this->getLoginEtu(),
            "idOffreTag" => $this->getIdOffre(),
            "etatTag" => $this->getEtat()
        );
    }


}