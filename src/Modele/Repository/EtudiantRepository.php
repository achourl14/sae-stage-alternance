<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;
use App\Modele\DataObject\Etudiant;
use DateTime;

class EtudiantRepository extends AbstractRepository
{
    public function sauvegarder(Etudiant $etudiant) : void {
        $sql = "INSERT INTO Etudiant VALUES(:codeINETag, :codeEtudiantTag, :promotionTag, :groupeTag, :parcoursTag,:nomEtudiantTag, :prenomEtudiantTag, :mailEtudiantTag, :telephoneEtudiantTag, :dateNaissanceEtudiantTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $etudiant->getCodeINE(),
            "codeEtudiantTag" => $etudiant->getNumEtudiant(),
            "promotionTag" => $etudiant->getPromotion(),
            "groupeTag" => $etudiant->getGroupe(),
            "nomEtudiantTag" => $etudiant->getNom(),
            "prenomEtudiantTag" => $etudiant->getPrenom(),
            "mailEtudiantTag" => $etudiant->getEmail(),
            "parcoursTag" => $etudiant->getParcours(),
            "telephoneEtudiantTag" => $etudiant->getNumTel(),
            "dateNaissanceEtudiantTag" => $etudiant->getDateDeNaissance(),
            "motDePasseTag" => $etudiant->getMdp()
        );

        $pdoStatement->execute($values);
    }

    // Tu dois faire une fontion trouve stage en fontion d'une année de manière a ce que je puisse vérifier si l'etudiant possède un stage dans l'année en cours


    public function stageTrouve($etudiant) {
        $sql ="SELECT codeINE FROM Etudiant e JOIN Stage s ON e.codeINE = s.idEtudiantStage WHERE e.codeINE = :codeINETag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $etudiant->getCodeINE()
        );

        $tableau = null;
        $pdoStatement->execute($values);
        if($pdoStatement->fetch() != null){
            foreach ($pdoStatement as $etudianttFormatTableau) {
                $tableau[] = $this->construireDepuisTableau($etudianttFormatTableau);
            }
        }
        return $tableau;
    }

    /*public function stageEnCoursTrouve(Etudiant $etudiant, DateTime $dateDebutStage, DateTime $dateFinStage) : bool
    {
        $sqlStage = "SELECT COUNT(*) as count_stage
                 FROM Etudiant e
                 JOIN Stage s ON e.codeINE = s.idEtudiantStage
                 WHERE e.codeINE = :codeINETag
                   AND (
                     (YEAR(s.dateDebutStage) = YEAR(CURRENT_DATE()) AND YEAR(s.dateFinStage) = YEAR(CURRENT_DATE()))
                     OR
                     (YEAR(s.dateDebutStage) = YEAR(CURRENT_DATE()) + 1 AND YEAR(s.dateFinStage) = YEAR(CURRENT_DATE()) + 1)
                   )";

        $sqlAlternance = "SELECT COUNT(*) as count_alternance
                     FROM Etudiant e
                     JOIN Alternance a ON e.codeINE = a.idEtudiantAlternant
                     WHERE e.codeINE = :codeINETag
                       AND (
                         (YEAR(a.dateDebutAlternance) = YEAR(CURRENT_DATE()) AND YEAR(a.dateFinAlternance) = YEAR(CURRENT_DATE()))
                         OR
                         (YEAR(a.dateDebutAlternance) != YEAR(CURRENT_DATE()) + 1 OR YEAR(a.dateFinAlternance) != YEAR(CURRENT_DATE()) + 1)
                       )";

        $pdo = ConnexionBaseDeDonnee::getPdo();

        $pdoStatementStage = $pdo->prepare($sqlStage);
        $pdoStatementAlternance = $pdo->prepare($sqlAlternance);

        $values = array(
            "codeINETag" => $etudiant->getCodeINE()
        );

        // Partie Stage
        $pdoStatementStage->execute($values);
        $countStage = $pdoStatementStage->fetchColumn();

        // Partie Alternance
        $pdoStatementAlternance->execute($values);
        $countAlternance = $pdoStatementAlternance->fetchColumn();

        // Vérification
        return ($countStage > 0 || $countAlternance > 0);
    }*/

    public function stageEnCoursTrouve(Etudiant $etudiant, DateTime $dateDebutStage, DateTime $dateFinStage) : bool
    {
        $pdo = ConnexionBaseDeDonnee::getPdo();

        // Vérification pour les stages
        $sqlStage = "SELECT COUNT(*) as count_stage
                 FROM Stage
                 WHERE idEtudiantStage = :codeINETag
                   AND dateDebutStage <= :dateFinStage
                   AND dateFinStage >= :dateDebutStage";

        $pdoStatementStage = $pdo->prepare($sqlStage);

        $valuesStage = array(
            "codeINETag" => $etudiant->getCodeINE(),
            "dateDebutStage" => $dateDebutStage->format('Y-m-d'),
            "dateFinStage" => $dateFinStage->format('Y-m-d')
        );

        $pdoStatementStage->execute($valuesStage);
        $countStage = $pdoStatementStage->fetchColumn();

        if ($countStage > 0) {
            return true; // La date fournie se trouve entre les dates de début et de fin d'au moins un stage
        }

        // Vérification pour les alternances
        $sqlAlternance = "SELECT COUNT(*) as count_alternance
                      FROM Alternance
                      WHERE idEtudiantAlternant = :codeINETag
                        AND dateDebutAlternance <= :dateFinStage
                        AND dateFinAlternance >= :dateDebutStage";

        $pdoStatementAlternance = $pdo->prepare($sqlAlternance);

        $valuesAlternance = array(
            "codeINETag" => $etudiant->getCodeINE(),
            "dateDebutStage" => $dateDebutStage->format('Y-m-d'),
            "dateFinStage" => $dateFinStage->format('Y-m-d')
        );

        $pdoStatementAlternance->execute($valuesAlternance);
        $countAlternance = $pdoStatementAlternance->fetchColumn();

        if ($countAlternance > 0) {
            return true; // La date fournie se trouve entre les dates de début et de fin d'au moins une alternance
        }

        return false; // Aucun conflit détecté
    }



    public function alternanceTrouve($etudiant){
        $sql ="SELECT codeINE FROM Etudiant e JOIN Alternance a ON e.codeINE = a.idEtudiantAlternant WHERE e.codeINE = :codeINETag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $etudiant->getCodeINE()
        );

        $pdoStatement->execute($values);
        if($pdoStatement->fetch() != null){
            return true;
        }
        else{
            return false;
        }
    }

    public function construireDepuisTableau(array $etudianttFormatTableau) : Etudiant {
        $etudiant= new Etudiant($etudianttFormatTableau['codeINE'],$etudianttFormatTableau['codeEtudiant'],$etudianttFormatTableau['groupe'],$etudianttFormatTableau['nomEtudiant'],$etudianttFormatTableau['prenomEtudiant'],$etudianttFormatTableau['parcours'],$etudianttFormatTableau['telephoneEtudiant'],$etudianttFormatTableau['mailEtudiant'],$etudianttFormatTableau['motDePasse'],$etudianttFormatTableau['dateNaissanceEtudiant'],$etudianttFormatTableau['promotion']);
        return $etudiant;
    }

    protected function getNomTable(): string
    {
        return "Etudiant";
    }

    public function getNomClePrimaire(): string
    {
        return "codeINE";
    }

    public function getNomsColones(): array
    {
        return array(
            "codeEtudiant",
            "promotion",
            "groupe",
            "nomEtudiant",
            "prenomEtudiant",
            "parcours",
            "mailEtudiant",
            "telephoneEtudiant",
            "dateNaissanceEtudiant",
            "motDePasse"
        );
    }
}