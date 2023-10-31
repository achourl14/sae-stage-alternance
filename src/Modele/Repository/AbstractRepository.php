<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\AbstractDataObject;

abstract class AbstractRepository
{
    public function recuperer()
    {
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM ".$this->getNomTable());
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    public function recupererParClePrimaire(string $valeurClePrimaire): ?AbstractDataObject{
        $sql = "SELECT * from ".$this->getNomTable()." WHERE ". $this->getNomClePrimaire()." = :valeurClePrimaireTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "valeurClePrimaireTag" => $valeurClePrimaire
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


    protected abstract function getNomTable(): string;
    protected abstract function getNomsColones(): array;
    protected abstract function getNomClePrimaire(): string;
    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;
}