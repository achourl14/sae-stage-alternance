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
            "motDePasseTag" => $etudiant->getMotDePasse()
        );

        $pdoStatement->execute($values);
    }

    public function construireDepuisTableau(array $etudiantFormatTableau) : Etudiant {
        $offreDeStage = new Etudiant($etudiantFormatTableau['codeINE'],$etudiantFormatTableau['codeEtudiant'],$etudiantFormatTableau['promotion'],$etudiantFormatTableau['groupe'],$etudiantFormatTableau['nomEtudiant'],$etudiantFormatTableau['prenomEtudiant'],$etudiantFormatTableau['mailEtudiant'],$etudiantFormatTableau['telephoneEtudiant'],$etudiantFormatTableau['dateNaissanceEtudiant'],$etudiantFormatTableau['motDePasse']);
        return $offreDeStage;
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
            "mailEtudiant",
            "telephoneEtudiant",
            "dateNaissanceEtudiant",
            "motDePasse"
        );
    }
}