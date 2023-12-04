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

    public function recupererEntrepriseAlternance()
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Entreprise e JOIN Offre o ON e.numSiret = o.idEntreprise JOIN Alternance a ON o.idOffre = a.idOffreAlternance");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function recupererEntrepriseStage()
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Entreprise e JOIN Offre o ON e.numSiret = o.idEntreprise JOIN Stage s ON o.idOffre = s.idOffreStage");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }



    public function construireDepuisTableau(array $entrepriseFormatTableau) : Entreprise {
        $entreprise = new Entreprise($entrepriseFormatTableau['numSiret'],$entrepriseFormatTableau['nomEntreprise'],$entrepriseFormatTableau['adresseEntreprise'],$entrepriseFormatTableau['telephoneEntreprise'],$entrepriseFormatTableau['adressemail'],$entrepriseFormatTableau['interlocuteurPrincipal'],$entrepriseFormatTableau['codeAPE'],$entrepriseFormatTableau['secteurActivite'],$entrepriseFormatTableau['motDePasse']);
        return $entreprise;
    }

    protected function getNomTable(): string
    {
        return "Entreprise";
    }

    public function getNomClePrimaire(): string
    {
        return "numSiret";
    }

    public function getNomsColones(): array
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