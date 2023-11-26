<?php

namespace App\Modele\DataObject;

use App\Lib\MotDePasse;

class Etudiant extends AbstractDataObject
{
    private string $login;
    private int|null $numEtudiant;
    private string|null $groupe;
    private string $nom;
    private string $prenom;
    private string|null $parcours;
    private string|null $numTel;
    private string|null $email;
    private string|null $motDePasse;
    private string|null $dateDeNaissance;
    private string|null $mailPerso;
    private string|null $sexe;
    private string|null $promotion;
    private int $premiereConnexion;

    public function __construct(string $login, int|null $numEtudiant,string $nom, string $prenom, string|null $email,string $promotion,string|null $groupe ,string|null $parcours ,string|null $numTel, string|null $motDePasse, string|null $dateDeNaissance,string|null $mailPerso,string|null $sexe, int $premiereConnexion) {
        $this->login = $login;
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
        $this->premiereConnexion = $premiereConnexion;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getNumEtudiant()
    {
        return $this->numEtudiant;
    }

    public function getGroupe()
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

    public function getNumTel()
    {
        return $this->numTel;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMdp()
    {
        return $this->motDePasse;
    }

    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    public function getPromotion()
    {
        return $this->promotion;
    }

    public function getParcours()
    {
        return $this->parcours;
    }

    public function getMailPerso()
    {
        return $this->mailPerso;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function getPremiereConnexion(): int
    {
        return $this->premiereConnexion;
    }




    public function formatTableau(): array
    {
        return array(
            "loginTag" => $this->getLogin(),
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
            "premiereConnexionTag" => $this->getPremiereConnexion(),
            "motDePasseTag" => $this->getMdp()
        );
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire) : Etudiant{
        $mdpHache = MotDePasse::hacher($tableauFormulaire['mdp']);
        return new Etudiant($tableauFormulaire["login"],$tableauFormulaire["codeEtudiant"],$tableauFormulaire["nomEtudiant"],$tableauFormulaire["prenomEtudiant"],$tableauFormulaire["mail"],$tableauFormulaire["promotion"],$tableauFormulaire["groupe"],$tableauFormulaire["parcours"],$tableauFormulaire["telephone"],$mdpHache,$tableauFormulaire["dateDeNaissance"],$tableauFormulaire["mailPerso"],$tableauFormulaire["sexe"],0);
    }


}
