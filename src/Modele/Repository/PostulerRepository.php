<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Postuler;

class PostulerRepository
{
    public function sauvegarder(Postuler $postuler) : void {
        $sql = "INSERT INTO Postuler VALUES(:codeINETag, :idOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $postuler->getCodeINE(),
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

    public function recupererParClePrimaire(string $codeINE, string $idOffre): ?Postuler{
        $sql = "SELECT * from ".$this->getNomTable()." WHERE idOffre = :idOffreTag AND codeINE = :codeINETag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idOffreTag" => $idOffre,
            "codeINETag" => $codeINE
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

    public function recupererParEtudiant(string $codeINE)
    {
        $sql = "SELECT * from " . $this->getNomTable() . " WHERE codeINE = :codeINETag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "codeINETag" => $codeINE
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        $tableau = null;
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
            if ($tableau == null) {
                return null;
            }
            return $tableau;
        }
    }


    public function construireDepuisTableau(array $offreFormatTableau) : Postuler {
        $offre = new Postuler($offreFormatTableau['codeINE'],$offreFormatTableau['idOffre']);
        return $offre;
    }

    public function getNomTable(){
        return "Postuler";
    }
}