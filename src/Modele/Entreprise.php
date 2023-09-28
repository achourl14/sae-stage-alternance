<?php

namespace App\Modele;

class Entreprise
{
    private int $num_siret;
    private string $nom_entreprise;
    private string $adresse;
    private int $telephone;
    private string $mail;
    private string $interlocuteur;
    private int $code_ape;
    private string $activite;
    private string $mdp;

    /**
     * @param int $num_siret
     * @param string $nom_entreprise
     * @param string $adresse
     * @param int $telephone
     * @param string $mail
     * @param string $interlocuteur
     * @param int $code_ape
     * @param string $activite
     * @param string $mdp
     */
    public function __construct(int $num_siret, string $nom_entreprise, string $adresse, int $telephone, string $mail, string $interlocuteur, int $code_ape, string $activite, string $mdp)
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

    public function sauvegarder() : void {
        $sql = "INSERT INTO Entreprise VALUES(:numSIRETTag, :nomEntrepriseTag, :adresseEntrepriseTag, :interlocuteurPrincipalTag, :telephoneEntrepriseTag, :codeAPETag, :secteurActiviteTag, :mailTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numSIRETTag" => $this->num_siret,
            "nomEntrepriseTag" => $this->nom_entreprise,
            "adresseEntrepriseTag" => $this->adresse,
            "interlocuteurPrincipalTag" => $this->interlocuteur,
            "telephoneEntrepriseTag" => $this->telephone,
            "codeAPETag" => $this->code_ape,
            "secteurActiviteTag" => $this->activite,
            "mailTag" => $this->mail,
            "motDePasseTag" => $this->mdp

        );

        $pdoStatement->execute($values);
    }

}