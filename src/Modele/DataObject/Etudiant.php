<?php

namespace App\Modele\DataObject;

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

}
