<?php

namespace App\Modele;

class Etudiant
{
    private int $codeINE;
    private int $numEtudiant;
    private string $groupe;
    private string $nom;
    private string $prenom;
    private int $numTel;
    private string $email;
    private string $motDePasse;
    private string $dateDeNaissance;

    private string $promotion;

    public function __construct(int $codeINE, int $numEtudiant,string $groupe ,string $nom, string $prenom, int $numTel, string $email, string $motDePasse, string $dateDeNaissance, string $promotion) {
        $this->codeINE = $codeINE;
        $this->numEtudiant = $numEtudiant;
        $this->groupe = $groupe;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numTel = $numTel;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->dateDeNaissance = $dateDeNaissance;
        $this->promotion = $promotion;
    }

    public function sauvegarder() : void {
        $sql = "INSERT INTO Etudiant VALUES(:codeINETag, :codeEtudiantTag, :promotionTag, :groupeTag, :nomEtudiantTag, :prenomEtudiantTag, :mailEtudiantTag, :telephoneEtudiantTag, :dateNaissaneEtudiantTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $this->codeINE,
            "codeEtudiantTag" => $this->codeINE,
            "promotionTag" => $this->promotion,
            "groupeTag" => $this->groupe,
            "nomEtudiantTag" => $this->nom,
            "prenomEtudiantTag" => $this->prenom,
            "mailEtudiantTag" => $this->email,
            "telephoneEtudiantTag" => $this->numTel,
            "dateNaissanceEtudiantTag" => $this->dateDeNaissance,
            "motDePasseTag" => $this->motDePasse
        );

        $pdoStatement->execute($values);
    }

}
