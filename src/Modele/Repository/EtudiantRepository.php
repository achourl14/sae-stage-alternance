<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Etudiant;

class EtudiantRepository extends AbstractRepository
{
    public function sauvegarder(Etudiant $etudiant) : void {
        $sql = "INSERT INTO Etudiant VALUES(:codeINETag, :codeEtudiantTag, :promotionTag, :groupeTag, :nomEtudiantTag, :prenomEtudiantTag, :mailEtudiantTag, :telephoneEtudiantTag, :dateNaissaneEtudiantTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $etudiant->getCodeINE(),
            "codeEtudiantTag" => $etudiant->getNumEtudiant(),
            "promotionTag" => $etudiant->getPromotion(),
            "groupeTag" => $etudiant->getGroupe(),
            "nomEtudiantTag" => $etudiant->getNom(),
            "prenomEtudiantTag" => $etudiant->getPrenom(),
            "mailEtudiantTag" => $etudiant->getEmail(),
            "telephoneEtudiantTag" => $etudiant->getNumTel(),
            "dateNaissanceEtudiantTag" => $etudiant->getDateDeNaissance(),
            "motDePasseTag" => $etudiant->getMdp()
        );

        $pdoStatement->execute($values);
    }

    public function stageTrouve($etudiant){
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

    public function alternanceTrouve($etudiant){
        $sql ="SELECT codeINE FROM Etudiant e JOIN Alternance a ON e.codeINE = a.idEtudiantAlternant WHERE e.codeINE = :codeINETag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $etudiant->getCodeINE()
        );

        $pdoStatement->execute($values);
        if($pdoStatement->fetch() != null){
            return true;
        }else{
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

    protected function getNomClePrimaire(): string
    {
        return "codeINE";
    }

    protected function getNomsColones(): array
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