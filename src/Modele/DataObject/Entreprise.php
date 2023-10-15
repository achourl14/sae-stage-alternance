<?php

namespace App\Modele\DataObject;

class Entreprise extends AbstractDataObject
{
    private int $num_siret;
    private string $nom_entreprise;
    private string $adresse;
    private int $telephone;
    private string $mail;
    private $interlocuteur;
    private string $code_ape;
    private $activite;
    private $mdp;

    /**
     * @param int $num_siret
     * @param string $nom_entreprise
     * @param string $adresse
     * @param int $telephone
     * @param string $mail
     * @param  $interlocuteur
     * @param string $code_ape
     * @param  $activite
     * @param  $mdp
     */
    public function __construct(int $num_siret,string $nom_entreprise, string $adresse, int $telephone, string $mail, $interlocuteur, string $code_ape, $activite, $mdp)
    {
        $this->num_siret = $num_siret;
        $this->nom_entreprise = $nom_entreprise;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->mail = $mail;
        $this->interlocuteur = $interlocuteur;
        $this->code_ape = $code_ape;
        $this->activite = $activite;
        $this->mdp = $mdp;
    }

    public function getNomEntreprise(): string
    {
        return $this->nom_entreprise;
    }

    public function getNumSiret(): int
    {
        return $this->num_siret;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getTelephone(): int
    {
        return $this->telephone;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getInterlocuteur(): ? string
    {
        return $this->interlocuteur;
    }

    public function getCodeApe(): string
    {
        return $this->code_ape;
    }

    public function getActivite(): ? string
    {
        return $this->activite;
    }

    public function getMdp(): ? string
    {
        return $this->mdp;
    }

    public function formatTableau(): array
    {
        return array(
            "numSiretTag" => $this->getNumSiret(),
            "nomEntrepriseTag" => $this->getNomEntreprise(),
            "adresseEntrepriseTag" => $this->getAdresse(),
            "interlocuteurPrincipalTag" => $this->getInterlocuteur(),
            "telephoneEntrepriseTag"  => $this->getTelephone(),
            "codeAPETag" => $this->getCodeApe(),
            "secteurActiviteTag" => $this->getActivite(),
            "adressemailTag" => $this->getMail(),
            "motDePasseTag" => $this->getMdp()
        );
    }


}