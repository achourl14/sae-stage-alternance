<?php

namespace App\Modele\DataObject;

class Offre extends AbstractDataObject
{
        private int $idOffre;
        private string $idEntreprise;
        private string $nomOffre;
        private string $mission;
        private string $statut;
        private int $validation;
        private string $dateDebut;
        private string $dateFin;
        private int $remuneration;
        private int $but_annee;
        private string $parcours;

        private string $type;
        private string $adresseDeOffre;
        private string $ville;
        private string $codePostal;

    /**
     * @param int $idOffre
     * @param string $idEntreprise
     * @param string $nomOffre
     * @param string $mission
     * @param string $statut
     * @param int $validation
     * @param string $dateDebut
     * @param string $dateFin
     * @param int $remuneration
     * @param int $but_annee
     * @param string $parcours
     */
    public function __construct(int $idOffre, string $idEntreprise, string $adresseDeOffre,string $ville, string $codePostal,string $nomOffre, string $mission, string $statut, int $validation, string $dateDebut, string $dateFin, int $remuneration, int $but_annee, string $parcours,string $type,int $inOut)
    {
        $this->idEntreprise = $idEntreprise;
        $this->adresseDeOffre = $adresseDeOffre;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->nomOffre = $nomOffre;
        $this->mission = $mission;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->remuneration = $remuneration;
        $this->but_annee = $but_annee;
        $this->parcours = $parcours;
        $this->type = $type;
        if($inOut == 1){
            self::construct2($idOffre,$statut,$validation);
        }
    }

    public function construct2(int $idOffre,string $statut, int $validation)
    {
        $this->idOffre = $idOffre;
        $this->statut = $statut;
        $this->validation = $validation;
    }

    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    public function getIdEntreprise(): string
    {
        return $this->idEntreprise;
    }

    public function getNomOffre(): string
    {
        return $this->nomOffre;
    }

    public function getMission(): string
    {
        return $this->mission;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function getValidation(): int
    {
        return $this->validation;
    }

    public function getDateDebut(): string
    {
        return $this->dateDebut;
    }

    public function getDateFin(): string
    {
        return $this->dateFin;
    }

    public function getRemuneration(): int
    {
        return $this->remuneration;
    }

    public function getButAnnee(): int
    {
        return $this->but_annee;
    }

    public function getParcours(): string
    {
        return $this->parcours;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAdresseDeOffre(): string
    {
        return $this->adresseDeOffre;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getCodePostal(): string
    {
        return $this->codePostal;
    }




    public function formatTableau(): array
    {
        return array(
            "idOffreTag" => $this->getIdOffre(),
            "idEntrepriseTag" => $this->getIdEntreprise(),
            "nomOffreTag" => $this->getNomOffre(),
            "missionTag" => $this->getMission(),
            "statutTag" => $this->getStatut(),
            "validationTag" => $this->getValidation(),
            "dateDebutTag" => $this->getDateDebut(),
            "dateFinTag" => $this->getDateFin(),
            "remunationTag" => $this->getRemuneration(),
            "but_anneeTag" => $this->getButAnnee(),
            "parcoursTag" => $this->getParcours(),
            "typeTag" => $this->getType(),
            "adresseDeOffreTag" => $this->getAdresseDeOffre(),
            "villeTag" => $this->getVille(),
            "codePostalTag" => $this->getCodePostal()
        );
    }



}