<?php

namespace App\Modele\DataObject;

use App\Lib\MotDePasse;

class Etudiant extends AbstractDataObject
{
    private string $codeINE;
    private int $numEtudiant;
    private string $groupe;
    private string $nom;
    private string $prenom;
    private string $parcours;
    private string $numTel;
    private string $email;
    private string $motDePasse;
    private string $dateDeNaissance;
    private string $mailPerso;
    private string $sexe;
    private string $promotion;

    public function __construct(string $codeINE, int $numEtudiant,string $groupe ,string $nom, string $prenom,string $parcours ,string $numTel, string $email, string $motDePasse, string $dateDeNaissance,string $mailPerso,string $sexe, string $promotion) {
        $this->codeINE = $codeINE;
        $this->numEtudiant = $numEtudiant;
        $this->groupe = $groupe;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->parcours = $parcours;
        $this->numTel = $numTel;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->dateDeNaissance = $dateDeNaissance;
        $this->mailPerso = $mailPerso;
        $this->sexe = $sexe;
        $this->promotion = $promotion;
    }

    public function getCodeINE(): string
    {
        return $this->codeINE;
    }

    public function getLogin(): string
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

    public function getNumTel(): string
    {
        return $this->numTel;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMdp(): string
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

    public function getParcours(): string
    {
        return $this->parcours;
    }

    public function getMailPerso(): string
    {
        return $this->mailPerso;
    }

    public function getSexe(): string
    {
        return $this->sexe;
    }



    public function formatTableau(): array
    {
        return array(
            "codeINETag" => $this->getCodeINE(),
            "codeEtudiantTag" => $this->getNumEtudiant(),
            "promotionTag" => $this->getPromotion(),
            "groupeTag" => $this->getGroupe(),
            "nomEtudiantTag" => $this->getNom(),
            "prenomEtudiantTag" => $this->getPrenom(),
            "parcoursTag" => $this->getParcours(),
            "mailEtudiantTag" => $this->getEmail(),
            "telephoneEtudiantTag" => $this->getNumTel(),
            "dateNaissanceEtudiantTag" => $this->getDateDeNaissance(),
            "mailPersoTag" => $this->getMailPerso(),
            "sexeTag" => $this->getSexe(),
            "motDePasseTag" => $this->getMdp()
        );
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire) : Etudiant{
        $mdpHache = MotDePasse::hacher($tableauFormulaire['mdp']);
        return new Etudiant($tableauFormulaire["codeINE"],$tableauFormulaire["codeEtudiant"],$tableauFormulaire["groupe"],$tableauFormulaire["nomEtudiant"],$tableauFormulaire["prenomEtudiant"],$tableauFormulaire["parcours"],$tableauFormulaire["telephone"],$tableauFormulaire["mail"],$mdpHache,$tableauFormulaire["dateDeNaissance"],$tableauFormulaire["mailPerso"],$tableauFormulaire["sexe"],$tableauFormulaire["promotion"]);
    }


}
