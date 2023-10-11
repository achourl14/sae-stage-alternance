<?php

namespace App\Modele\Repository;
use App\Modele\DataObject\Entreprise;

class EntrepriseRepository extends AbstractRepository
{
    public static function sauvegarder(Entreprise $entreprise) : void {
        $sql = "INSERT INTO Entreprise VALUES(:numSIRETTag, :nomEntrepriseTag, :adresseEntrepriseTag, :interlocuteurPrincipalTag, :telephoneEntrepriseTag, :codeAPETag, :secteurActiviteTag, :mailTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numSIRETTag" => $entreprise->getNumSiret(),
            "nomEntrepriseTag" => $entreprise->getNomEntreprise(),
            "adresseEntrepriseTag" => $entreprise->getAdresse(),
            "interlocuteurPrincipalTag" => $entreprise->getInterlocuteur(),
            "telephoneEntrepriseTag" => $entreprise->getTelephone(),
            "codeAPETag" => $entreprise->getCodeApe(),
            "secteurActiviteTag" => $entreprise->getActivite(),
            "mailTag" => $entreprise->getMail(),
            "motDePasseTag" => $entreprise->getMdp()

        );

        $pdoStatement->execute($values);
    }

    public static function sauvegarderExterne($num_siret, $nom_entreprise, $adresse, $telephone, $mail, $code_ape) {
        $entreprise = new Entreprise($num_siret, $nom_entreprise, $adresse, $telephone, $mail, null, $code_ape, null, null);
        $sql = "INSERT INTO Entreprise VALUES(:numSIRETTag, :nomEntrepriseTag, :adresseEntrepriseTag, null, :telephoneEntrepriseTag, :codeAPETag, null, :mailTag, null)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "numSIRETTag" => $entreprise->getNumSiret(),
            "nomEntrepriseTag" => $entreprise->getNomEntreprise(),
            "adresseEntrepriseTag" => $entreprise->getAdresse(),
            "telephoneEntrepriseTag" => $entreprise->getTelephone(),
            "codeAPETag" => $entreprise->getCodeApe(),
            "mailTag" => $entreprise->getMail(),
        );

        $pdoStatement->execute($values);
    }


    public function construireDepuisTableau(array $entrepriseFormatTableau) : Entreprise {
        $entreprise = new Entreprise($entrepriseFormatTableau['numSiret'],$entrepriseFormatTableau['nomEntreprise'],$entrepriseFormatTableau['adresseEntreprise'],$entrepriseFormatTableau['telephoneEntreprise'],$entrepriseFormatTableau['adressemail'],$entrepriseFormatTableau['interlocuteurPrincipal'],$entrepriseFormatTableau['codeAPE'],$entrepriseFormatTableau['secteurActivite'],$entrepriseFormatTableau['motDePasse']);
        return $entreprise;
    }

    protected function getNomTable(): string
    {
        return "Entreprise";
    }

    protected function getNomClePrimaire(): string
    {
        return "numSiret";
    }

    protected function getNomsColones(): array
    {
        return array(
          "nomEntreprise",
          "adresseEntreprise",
          "interlocuteurPrincipal",
          "telephoneEntreprise",
          "codeAPE",
          "secteurActivite",
          "adressemail",
          "motDePasse"
        );
    }
}