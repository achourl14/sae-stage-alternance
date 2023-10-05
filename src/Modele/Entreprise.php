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
    private string $code_ape;
    private string $activite;
    private string $mdp;

    /**
     * @param int $num_siret
     * @param string $nom_entreprise
     * @param string $adresse
     * @param int $telephone
     * @param string $mail
     * @param string $interlocuteur
     * @param string $code_ape
     * @param string $activite
     * @param string $mdp
     */
    public function __construct(int $num_siret, string $nom_entreprise, string $adresse, int $telephone, string $mail, string $interlocuteur, string $code_ape, string $activite, string $mdp)
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

    public function getNomEntreprise(): string
    {
        return $this->nom_entreprise;
    }



    public static function construireDepuisTableau(array $entrepriseFormatTableau) : Entreprise {
        $entreprise = new Entreprise($entrepriseFormatTableau['numSiret'],$entrepriseFormatTableau['nomEntreprise'],$entrepriseFormatTableau['adresseEntreprise'],$entrepriseFormatTableau['telephoneEntreprise'],$entrepriseFormatTableau['adressemail'],$entrepriseFormatTableau['interlocuteurPrincipal'],$entrepriseFormatTableau['codeAPE'],$entrepriseFormatTableau['secteurActivite'],$entrepriseFormatTableau['motDePasse']);
        return $entreprise;
    }

    public static function getEntrepriseParSiret($numSiret) : ?Entreprise{
        $sql = "SELECT * from Entreprise WHERE numSiret = :numSiretTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numSiretTag" => $numSiret,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de voiture correspondante
        $entrepriseFormatTableau = $pdoStatement->fetch();
        if($entrepriseFormatTableau == null){
            return null;
        }
        return self::construireDepuisTableau($entrepriseFormatTableau);
    }

}