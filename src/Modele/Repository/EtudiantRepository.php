<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Secretariat;

class EtudiantRepository extends AbstractRepository
{
    public function sauvegarder(Secretariat $etudiant) : void {
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

    public function construireDepuisTableau(array $setudianttFormatTableau) : Secretariat {
        $offreDeStage = new Secretariat($setudianttFormatTableau['codeINE'],$setudianttFormatTableau['codeEtudiant'],$setudianttFormatTableau['promotion'],$setudianttFormatTableau['groupe'],$setudianttFormatTableau['nomEtudiant'],$setudianttFormatTableau['prenomEtudiant'],$setudianttFormatTableau['mailEtudiant'],$setudianttFormatTableau['telephoneEtudiant'],$setudianttFormatTableau['dateNaissanceEtudiant'],$setudianttFormatTableau['motDePasse']);
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