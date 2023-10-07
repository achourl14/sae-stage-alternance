<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Etudiant;

class EtudiantRepository
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
}