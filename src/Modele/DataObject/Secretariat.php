<?php

namespace App\Modele\DataObject;

use App\Lib\MotDePasse;

class Secretariat extends AbstractDataObject
{
    private string $login;
    private string $nomSecretariat;
    private string $prenomSecretariat;
    private string|null $mailSecretariat;
    private string|null $telephoneSecretariat;
    private string|null $dateDeNaissanceSecretariat;
    private string|null $role;
    private string|null $mdp;
    private int $premiereConnexion;
    /**
     * @param string $nomSecretariat
     * @param string $prenomSecretariat
     * @param int $mdp
     */
    public function __construct(string $login, string $nomSecretariat, string $prenomSecretariat, string|null $mail, string|null $telephone, string|null $dateDeNaissance, string|null $role, string|null $mdp, int $premiereConnexion)
    {
        $this->login = $login;
        $this->nomSecretariat = $nomSecretariat;
        $this->prenomSecretariat = $prenomSecretariat;
        $this->mailSecretariat = $mail;
        $this->telephoneSecretariat = $telephone;
        $this->dateDeNaissanceSecretariat = $dateDeNaissance;
        $this->role = $role;
        $this->mdp = $mdp;
        $this->premiereConnexion = $premiereConnexion;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getNomSecretariat(): string
    {
        return $this->nomSecretariat;
    }

    public function getPrenomSecretariat(): string
    {
        return $this->prenomSecretariat;
    }

    public function getMail()
    {
        return $this->mailSecretariat;
    }

    public function getTelephone()
    {
        return $this->telephoneSecretariat;
    }

    public function getDateDeNaissance()
    {
        return $this->dateDeNaissanceSecretariat;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getPremiereConnexion(): int
    {
        return $this->premiereConnexion;
    }



    public static function construireDepuisFormulaire(array $tableauFormulaire) : Secretariat{
        $mdpHache = MotDePasse::hacher($tableauFormulaire['mdp']);
        return new Secretariat($tableauFormulaire["login"],$tableauFormulaire["nomSecretariat"],$tableauFormulaire["prenomSecretariat"],$tableauFormulaire["mailSecretariat"],$tableauFormulaire["telephoneSecretariat"],$tableauFormulaire["dateDeNaissanceSecretariat"],$tableauFormulaire["role"],$mdpHache,0);
    }

    public function formatTableau(): array
    {
        return array(
            "loginTag" => $this->getLogin(),
            "nomSecretariatTag" => $this->getNomSecretariat(),
            "prenomSecretariatTag" => $this->getPrenomSecretariat(),
            "adresseMailTag" => $this->getMail(),
            "telephoneTag" => $this->getTelephone(),
            "dateDeNaissanceTag" => $this->getDateDeNaissance(),
            "roleTag" => $this->getRole(),
            "mdpTag" => $this->getMdp(),
            "premiereConnexionTag" => $this->getPremiereConnexion()
        );
    }
}