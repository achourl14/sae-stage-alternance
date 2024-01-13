<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;
use App\Modele\DataObject\Etudiant;
use App\Modele\DataObject\Secretariat;
use DateTime;

class EtudiantRepository extends AbstractRepository
{
    public function sauvegarder(Etudiant $etudiant) : void
    {
        $sql = "INSERT INTO Etudiant VALUES(:loginTag, :codeEtudiantTag, :nomEtudiantTag, :prenomEtudiantTag, :mailEtudiantTag, :promotionTag, :groupeTag, :parcoursTag, :telephoneEtudiantTag, :dateNaissanceEtudiantTag, :mailPersoTag, :sexeTag, :premiereConnexionTag ,:motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginTag" => $etudiant->getLogin(),
            "codeEtudiantTag" => $etudiant->getNumEtudiant(),
            "nomEtudiantTag" => $etudiant->getNom(),
            "prenomEtudiantTag" => $etudiant->getPrenom(),
            "mailEtudiantTag" => $etudiant->getEmail(),
            "promotionTag" => $etudiant->getPromotion(),
            "groupeTag" => $etudiant->getGroupe(),
            "parcoursTag" => $etudiant->getParcours(),
            "telephoneEtudiantTag" => $etudiant->getNumTel(),
            "dateNaissanceEtudiantTag" => $etudiant->getDateDeNaissance(),
            "mailPersoTag" => $etudiant->getMailPerso(),
            "sexeTag" => $etudiant->getSexe(),
            "premiereConnexionTag" => $etudiant->getPremiereConnexion(),
            "motDePasseTag" => $etudiant->getMdp()
        );

        $pdoStatement->execute($values);
    }

    public function recupererDepuisNumEtudiant(string $numEtudiant) : ?Etudiant
    {
        $sql = "SELECT * FROM Etudiant WHERE codeEtudiant = :codeEtudiantTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeEtudiantTag" => $numEtudiant
        );

        $pdoStatement->execute($values);
        $objetFormatTableau = $pdoStatement->fetch();
        if ($objetFormatTableau != null) {
            return $this->construireDepuisTableau($objetFormatTableau);
        } else {
            return null;
        }
    }

    public function recupererParTuteur(Secretariat $personnel)
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Etudiant e JOIN ConventionStageFinale c ON c.numEtudiant = e.codeEtudiant JOIN Secretariat s ON c.nomEnseignantReferent = s.nomSecretariat WHERE prenomEnseignentReferent = prenomSecretariat AND nomEnseignantReferent ='".$personnel->getNomSecretariat()."' AND prenomEnseignentReferent ='".$personnel->getPrenomSecretariat()."'");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    // Tu dois faire une fontion trouve stage en fontion d'une année de manière a ce que je puisse vérifier si l'etudiant possède un stage dans l'année en cours


    public function stageTrouve($etudiant) {
        $sql ="SELECT login FROM Etudiant e JOIN Stage s ON e.login = s.loginEtuStage WHERE e.login = :loginTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginTag" => $etudiant->getLogin()
        );

        $tableau = null;
        $pdoStatement->execute($values);
        if($pdoStatement->fetch() != null){
            return true;
        }else{
            return false;
        }
    }

    public function nombreEtudiant(array $parameters){
        $sql = "SELECT COUNT(login) FROM Etudiant";

        if($parameters != null){
            $sql .= " WHERE ";
            foreach ($parameters as $clef => $valeur) {
                $sql.= $clef ." = ". $valeur;
            }
        }
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);
        return $pdoStatement->fetchColumn();
    }

    public function nombreDePersonneTrouveStage(array $parameters) :int{
        $sql = "SELECT COUNT(login) FROM Etudiant e JOIN Stage s ON e.login = s.loginEtuStage";

        if($parameters != null){
            $sql .= " WHERE ";
            foreach ($parameters as $clef => $valeur) {
                $sql.= $clef ." = ". $valeur;
            }
        }
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);
        return $pdoStatement->fetchColumn();
    }
    public function nombreDePersonneTrouveAlternance(array $parameters) :int{
        $sql = "SELECT COUNT(login) FROM Etudiant e JOIN Alternance a ON e.login = a.loginEtuAlternance";

        if($parameters != null){
            $sql .= " WHERE ";
            foreach ($parameters as $clef => $valeur) {
                $sql.= $clef ." = ". $valeur;
            }
        }
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);
        return $pdoStatement->fetchColumn();
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
                 WHERE loginEtuStage = :loginTag
                   AND dateDebutStage <= :dateFinStage
                   AND dateFinStage >= :dateDebutStage";

        $pdoStatementStage = $pdo->prepare($sqlStage);

        $valuesStage = array(
            "loginTag" => $etudiant->getLogin(),
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
                      WHERE loginEtuAlternant = :loginTag
                        AND dateDebutAlternance <= :dateFinStage
                        AND dateFinAlternance >= :dateDebutStage";

        $pdoStatementAlternance = $pdo->prepare($sqlAlternance);

        $valuesAlternance = array(
            "loginTag" => $etudiant->getLogin(),
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
        $sql ="SELECT login FROM Etudiant e JOIN Alternance a ON e.login = a.loginEtuAlternance WHERE e.login = :loginTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginTag" => $etudiant->getLogin()
        );

        $pdoStatement->execute($values);
        if($pdoStatement->fetch() != null){
            return true;
        }
        else{
            return false;
        }
    }


    public function recupererEtudiantStage()
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Etudiant e JOIN Stage s ON e.login = s.loginEtuStage");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function recupererEtudiantAlternance()
    {
        $tableau = null;
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM Etudiant e JOIN Alternance a ON e.login = a.loginEtuAlternance");
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function construireDepuisTableau(array $etudianttFormatTableau) : Etudiant {
        $etudiant= new Etudiant($etudianttFormatTableau['login'],$etudianttFormatTableau['codeEtudiant'],$etudianttFormatTableau['nomEtudiant'],$etudianttFormatTableau['prenomEtudiant'],$etudianttFormatTableau['mailEtudiant'],$etudianttFormatTableau['promotion'],$etudianttFormatTableau['groupe'],$etudianttFormatTableau['parcours'],$etudianttFormatTableau['telephoneEtudiant'],$etudianttFormatTableau['motDePasse'],$etudianttFormatTableau['dateNaissanceEtudiant'],$etudianttFormatTableau['mailPerso'],$etudianttFormatTableau['sexe'],$etudianttFormatTableau['premiereConnexion']);
        return $etudiant;
    }

    protected function getNomTable(): string
    {
        return "Etudiant";
    }

    public function getNomClePrimaire(): string
    {
        return "login";
    }

    public function getNomsColones(): array
    {
        return array(
            "codeEtudiant",
            "nomEtudiant",
            "prenomEtudiant",
            "mailEtudiant",
            "promotion",
            "groupe",
            "parcours",
            "telephoneEtudiant",
            "dateNaissanceEtudiant",
            "mailPerso",
            "sexe",
            "premiereConnexion",
            "motDePasse"
        );
    }
}