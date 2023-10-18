<?php

namespace App\Modele\DataObject;

use App\Lib\MotDePasse;

class Secretariat extends AbstractDataObject
{
    private string $idSecretariat;
    private string $nomSecretariat;
    private string $prenomSecretariat;
    private string $mdp;

    /**
     * @param int $idSecretariat
     * @param string $nomSecretariat
     * @param string $prenomSecretariat
     * @param int $mdp
     */
    public function __construct(string $idSecretariat, string $nomSecretariat, string $prenomSecretariat, string $mdp)
    {
        $this->idSecretariat = $idSecretariat;
        $this->nomSecretariat = $nomSecretariat;
        $this->prenomSecretariat = $prenomSecretariat;
        $this->mdp = $mdp;
    }

    public function getIdSecretariat(): string
    {
        return $this->idSecretariat;
    }

    public function getLogin(): string
    {
        return $this->idSecretariat;
    }

    public function getNomSecretariat(): string
    {
        return $this->nomSecretariat;
    }

    public function getPrenomSecretariat(): string
    {
        return $this->prenomSecretariat;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire) : Secretariat{
        $mdpHache = MotDePasse::hacher($tableauFormulaire['mdp']);
        return new Secretariat($tableauFormulaire["idSecretariat"],$tableauFormulaire["nomSecretariat"],$tableauFormulaire["prenomSecretariat"],$mdpHache);
    }

    public function formatTableau(): array
    {
        return array(
            "idSecretariatTag" => $this->getIdSecretariat(),
            "prenomSecretariatTag" => $this->getPrenomSecretariat(),
            "nomSecretariatTag" => $this->getNomSecretariat(),
            "motDePasseTag" => $this->getMdp()
        );
    }
}