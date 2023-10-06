<?php

namespace App\Modele\Repository;

class EtudiantRepository
{
    public function sauvegarder($etudiant) : void {
        $sql = "INSERT INTO Etudiant VALUES(:codeINETag, :codeEtudiantTag, :promotionTag, :groupeTag, :nomEtudiantTag, :prenomEtudiantTag, :mailEtudiantTag, :telephoneEtudiantTag, :dateNaissaneEtudiantTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $etudiant->codeINE,
            "codeEtudiantTag" => $etudiant->codeINE,
            "promotionTag" => $etudiant->promotion,
            "groupeTag" => $etudiant->groupe,
            "nomEtudiantTag" => $etudiant->nom,
            "prenomEtudiantTag" => $etudiant->prenom,
            "mailEtudiantTag" => $etudiant->email,
            "telephoneEtudiantTag" => $etudiant->numTel,
            "dateNaissanceEtudiantTag" => $etudiant->dateDeNaissance,
            "motDePasseTag" => $etudiant->motDePasse
        );

        $pdoStatement->execute($values);
    }
}