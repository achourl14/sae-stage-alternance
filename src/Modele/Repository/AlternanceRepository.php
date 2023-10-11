<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Etudiant;

class AlternanceRepository extends AbstractRepository
{
    public static function sauvegarder(Alternance $alternance) : void {
        $sql = "INSERT INTO Alternance VALUES(:idEtudiantAlternantTag, :numOffreAlternanceTag, :numMaitreDeAlternanceTag, :idTuteurAlternanceTag, :dateDebutAlternanceTag, :dateFinAlternanceTag, :remunerationTag, :numSiretEntrepriseAlternanceExterieurTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEtudiantAlternantTag" => $alternance->getIdEtudiantAlternant(),
            "numOffreAlternanceTag" => $alternance->getNumOffreAltrenance(),
            "numMaitreDeAlternanceTag" => $alternance->getNumMaitreAlternance(),
            "idTuteurAlternanceTag" => $alternance->getIdTuteurAlternance(),
            "dateDebutAlternanceTag" => $alternance->getDateDebutAlternance(),
            "dateFinAlternanceTag" => $alternance->getDateFinAlternance(),
            "remunerationTag" => $alternance->getRemuneration(),
            "numSiretEntrepriseAlternanceExterieurTag" => $alternance->getNumSiretEntrepriseExterieur()
        );

        $pdoStatement->execute($values);
    }

    protected function getNomClePrimaire(): string
    {
        return "peutpas";
    }

    protected function getNomTable(): string
    {
        return "Alternance";
    }

    protected function getNomsColones(): array
    {
        return array();
    }

    // si utiliser reprendre la fonction entière
    public function construireDepuisTableau(array $stageFormatEtudiant) : Alternance {
        $alternance = new Alternance($stageFormatEtudiant['codeINE'],$stageFormatEtudiant['codeEtudiant'],$stageFormatEtudiant['promotion'],$stageFormatEtudiant['groupe'],$stageFormatEtudiant['nomEtudiant'],$stageFormatEtudiant['prenomEtudiant'],$stageFormatEtudiant['mailEtudiant'],$stageFormatEtudiant['telephoneEtudiant']);
        return $alternance;
    }

}