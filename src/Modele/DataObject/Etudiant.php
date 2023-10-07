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

    public function getCodeINE(): int
    {
        return $this->codeINE;
    }

    public function getNumEtudiant(): int
    {
        return $this->numEtudiant;
    }

    public function getGroupe(): string
    {
        return $this->groupe;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getNumTel(): int
    {
        return $this->numTel;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function getDateDeNaissance(): string
    {
        return $this->dateDeNaissance;
    }

    public function getPromotion(): string
    {
        return $this->promotion;
    }



}
