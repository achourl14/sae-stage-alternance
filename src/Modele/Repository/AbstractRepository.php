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

    public function supprimer($valeurClePrimaire){
        $sql = "DELETE FROM ". $this->getNomTable() ." WHERE ". $this->getNomClePrimaire() ." = :valeurClePrimaireTag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "valeurClePrimaireTag" => $valeurClePrimaire
        );

        $pdoStatement->execute($values);
    }

    public  function mettreAJour(AbstractDataObject $objet){
        $colonesql ="";
        $colones = $this->getNomsColones();
        for($i=0;$i<count($colones);$i++){
            $colonesql .= $colones[$i] . "= :" . $colones[$i] . "Tag";
            if($i<count($colones)-1){
                $colonesql .= ", ";
            }
        }
        $sql = "UPDATE ". $this->getNomTable() ." SET ".$colonesql." WHERE ".$this->getNomClePrimaire()."= :" . $this->getNomClePrimaire()."Tag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = $objet->formatTableau();

        $pdoStatement->execute($values);
    }

    public function recupererAvecFiltre(array $parameters) : ?array {
        $colonesql = "";
        $values = null;
        $i=0;
        $j=0;
        if($parameters != null){
            foreach($parameters as $clef => $valeur){
                if($i != 0){
                    $colonesql .= " AND ";
                }
                $i = $i + 1;
                // type spécial
                if($clef == "type"){
                    $colonesql .= $clef . " IN (";
                    $cpt = count($valeur);
                    foreach($valeur as $valIn){
                        $colonesql .= ":".$valIn . "Tag";
                        if($cpt-1 != $j){
                            $colonesql .= ",";
                        }
                        $expressionType = $valIn . "Tag";
                        $values[$expressionType] = $valIn;
                        $j+=1;
                    }
                    $colonesql .= ")";


                }else{
                    $colonesql .= $clef . " = ";
                    $colonesql .= ":".$clef . "Tag";

                    $expression = $clef . "Tag";
                    $values[$expression] = $valeur;
                }
            }

        }
        $tableau = null;
        $sql = "SELECT * FROM ".$this->getNomTable(). " WHERE ". $colonesql;
        var_dump($sql);
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);


        var_dump($values);
        $pdoStatement->execute($values);
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    protected abstract function getNomTable(): string;
    protected abstract function getNomsColones(): array;
    protected abstract function getNomClePrimaire(): string;
    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;
}