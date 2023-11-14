<?php

namespace App\Modele\DataObject;

use App\Lib\MotDePasse;

class Secretariat extends AbstractDataObject
{
    private string $idSecretariat;
    private string $nomSecretariat;
    private string $prenomSecretariat;
    private string $mailSecretariat;
    private string $telephoneSecretariat;
    private string $dateDeNaissanceSecretariat;
    private string $role;
    private string $mdp;

    /**
     * @param int $idSecretariat
     * @param string $nomSecretariat
     * @param string $prenomSecretariat
     * @param int $mdp
     */
    public function __construct(string $idSecretariat, string $nomSecretariat, string $prenomSecretariat, string $mail, string $telephone, string $dateDeNaissance, string $role, string $mdp)
    {
        $this->idSecretariat = $idSecretariat;
        $this->nomSecretariat = $nomSecretariat;
        $this->prenomSecretariat = $prenomSecretariat;
        $this->mailSecretariat = $mail;
        $this->telephoneSecretariat = $telephone;
        $this->dateDeNaissanceSecretariat = $dateDeNaissance;
        $this->role = $role;
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

    public function getMail(): string
    {
        return $this->mailSecretariat;
    }

    public function getTelephone(): string
    {
        return $this->telephoneSecretariat;
    }

    public function getDateDeNaissance(): string
    {
        return $this->dateDeNaissanceSecretariat;
    }
    public function getRole(): string
    {
        return $this->role;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire) : Secretariat{
        $mdpHache = MotDePasse::hacher($tableauFormulaire['mdp']);
        return new Secretariat($tableauFormulaire["idSecretariat"],$tableauFormulaire["nomSecretariat"],$tableauFormulaire["prenomSecretariat"],$tableauFormulaire["mailSecretariat"],$tableauFormulaire["telephoneSecretariat"],$tableauFormulaire["dateDeNaissanceSecretariat"],$tableauFormulaire["role"],$mdpHache);
    }

    public function formatTableau(): array
    {
        return array(
            "idSecretariatTag" => $this->getIdSecretariat(),
            "nomSecretariatTag" => $this->getNomSecretariat(),
            "prenomSecretariatTag" => $this->getPrenomSecretariat(),
            "adresseMailTag" => $this->getMail(),
            "telephoneTag" => $this->getTelephone(),
            "dateDeNaissanceTag" => $this->getDateDeNaissance(),
            "roleTag" => $this->getRole(),
            "mdpTag" => $this->getMdp()
        );
    }
}