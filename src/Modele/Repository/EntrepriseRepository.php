<?php

namespace App\Modele\Repository;
use App\Modele\DataObject\Entreprise;

class EntrepriseRepository
{
    public static function sauvegarder($entreprise) : void {
        $sql = "INSERT INTO Entreprise VALUES(:numSIRETTag, :nomEntrepriseTag, :adresseEntrepriseTag, :interlocuteurPrincipalTag, :telephoneEntrepriseTag, :codeAPETag, :secteurActiviteTag, :mailTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numSIRETTag" => $entreprise->num_siret,
            "nomEntrepriseTag" => $entreprise->nom_entreprise,
            "adresseEntrepriseTag" => $entreprise->adresse,
            "interlocuteurPrincipalTag" => $entreprise->interlocuteur,
            "telephoneEntrepriseTag" => $entreprise->telephone,
            "codeAPETag" => $entreprise->code_ape,
            "secteurActiviteTag" => $entreprise->activite,
            "mailTag" => $entreprise->mail,
            "motDePasseTag" => $entreprise->mdp

        );

        $pdoStatement->execute($values);
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