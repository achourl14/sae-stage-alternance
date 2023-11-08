<?php

namespace App\Modele\Repository;



use App\Modele\DataObject\Offre;

class OffreRepository extends AbstractRepository
{

    public function construireDepuisTableau(array $offreFormatTableau) : Offre {
        $offre = new Offre($offreFormatTableau['idOffre'],$offreFormatTableau['idEntreprise'],$offreFormatTableau['nomOffre'],$offreFormatTableau['mission'],$offreFormatTableau['statut'],$offreFormatTableau['validation'],$offreFormatTableau['dateDebut'],$offreFormatTableau['dateFin'],$offreFormatTableau['remuneration'],$offreFormatTableau['but_annee'],$offreFormatTableau['parcours'],$offreFormatTableau['type'],1);
        return $offre;
    }

    public static function sauvegarder(Offre $offre) : void {

        $sql = "INSERT INTO Offre (idEntreprise, nomOffre, mission, dateDebut, dateFin, remuneration,but_annee,parcours,type) VALUES (:idEntrepriseTag, :nomOffreTag,:missionTag, :dateDebutTag, :dateFinTag, :remunerationTag, :but_anneeTag,:parcoursTag,:typeTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $offre->getIdEntreprise(),
            "nomOffreTag" => $offre->getNomOffre(),
            "missionTag" => $offre->getMission(),
            "dateDebutTag" => $offre->getDateDebut(),
            "dateFinTag" => $offre->getDateFin(),
            "remunerationTag" => $offre->getRemuneration(),
            "but_anneeTag" => $offre->getButAnnee(),
            "parcoursTag" => $offre->getParcours(),
            "typeTag" => $offre->getType()

        );
        $pdoStatement->execute($values);
    }

    public function recupererOffreValide()
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Offre WHERE validation = 1");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public static function validerOffre(Offre $offre) : void {

        $sql = "UPDATE Offre SET validation = :validationTag WHERE idOffre = :idOffreTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);


        if ($offre->getValidation() == 0) {
            $values = array(
                "validationTag" => 1,
                "idOffreTag" => $offre->getIdOffre(),
            );
            $pdoStatement->execute($values);
        }
        else{
            $values = array(
                "validationTag" => 0,
                "idOffreTag" => $offre->getIdOffre(),
            );
            $pdoStatement->execute($values);
        }
    }

    public function derniereOffre() : Offre
    {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Offre WHERE idOffre = (SELECT MAX(idOffre) FROM Offre)");

        $derniereOffre = $pdoStatement->fetch();
        return $this->construireDepuisTableau($derniereOffre);
    }

    protected function getNomsColones(): array
    {
        return array(
            "idEntreprise",
            "nomOffre",
            "mission",
            "statut",
            "validation",
            "dateDebut",
            "dateFin",
            "remuneration",
            "but_annee",
            "parcours",
            "type"
        );
    }

    protected function getNomTable(): string
    {
        return "Offre";
    }

    protected function getNomClePrimaire(): string
    {
        return "idOffre";
    }

}