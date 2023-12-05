<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Postuler;

class PostulerRepository
{
    public function sauvegarder(Postuler $postuler) : void {
        $sql = "INSERT INTO Postuler VALUES(:loginEtuTag, :idOffreTag, 0)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuTag" => $postuler->getloginEtu(),
            "idOffreTag" => $postuler->getIdOffre()
        );

        $pdoStatement->execute($values);
    }
    public function recuperer(){
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM ".$this->getNomTable());
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function recupererParClePrimaire(string $loginEtu, string $idOffre): ?Postuler{
        $sql = "SELECT * from ".$this->getNomTable()." WHERE idOffre = :idOffreTag AND loginEtu = :loginEtuTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idOffreTag" => $idOffre,
            "loginEtuTag" => $loginEtu
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        // On récupère les résultats comme précédemment
        // Note: fetch() renvoie false si pas de objet correspondante
        $objetFormatTableau = $pdoStatement->fetch();
        if($objetFormatTableau == null){
            return null;
        }
        return $this->construireDepuisTableau($objetFormatTableau);
    }

    public function recupererParEtudiant(string $loginEtu)
    {
        $sql = "SELECT * from " . $this->getNomTable() . " WHERE loginEtu = :loginEtuTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuTag" => $loginEtu
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        $tableau = null;
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function recupererParOffre(int $idOffre)
    {
        $sql = "SELECT * from " . $this->getNomTable() . " WHERE idOffre = :idOffreTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idOffreTag" => $idOffre
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        $tableau = null;
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function deleteAllPostulerFromEtudiant($login){
        $sql = "DELETE FROM Postuler WHERE loginEtu = :loginEtuTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuTag" => $login
        );

        $pdoStatement->execute($values);
    }

    public function mettreAJourEtat(Postuler $postuler){
        $sql = "UPDATE Postuler SET etat = :etatTag WHERE loginEtu = :loginEtuTag AND idOffre = :idOffreTag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuTag" => $postuler->getLoginEtu(),
            "idOffreTag" => $postuler->getIdOffre(),
            "etatTag" => $postuler->getEtat()
        );
        $pdoStatement->execute($values);
    }


    public function construireDepuisTableau(array $offreFormatTableau) : Postuler {
        $offre = new Postuler($offreFormatTableau['loginEtu'],$offreFormatTableau['idOffre'],$offreFormatTableau['etat']);
        return $offre;
    }

    public function getNomTable(){
        return "Postuler";
    }
}