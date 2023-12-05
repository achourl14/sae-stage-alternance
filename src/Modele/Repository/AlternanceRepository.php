<?php

namespace App\Modele\Repository;

use App\Modele\DataObject\Alternance;

class AlternanceRepository extends AbstractRepository
{
    public static function sauvegarder(Alternance $alternance) : void {
        $sql = "INSERT INTO Alternance VALUES(:loginEtuAlternance, :idOffreAlternance)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuAlternanceTag" => $alternance->getLoginEtuAlternance(),
            "idOffreAlternanceTag" => $alternance->getIdOffreAlternance()
        );

        $pdoStatement->execute($values);
    }

    public function recupererDepuisClePrimaire(string $loginEtuAlternance, string $idOffreAlternance): ?Alternance{
        $sql = "SELECT * from ".$this->getNomTable()." WHERE idOffreAlternance = :idOffreAlternanceTag AND loginEtuAlternance = :loginEtuAlternanceTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idOffreAlternanceTag" => $idOffreAlternance,
            "loginEtuStageTag" => $loginEtuAlternance
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

    public function recupererParEtudiant(string $loginEtuAlternance)
    {
        $sql = "SELECT * from " . $this->getNomTable() . " WHERE loginEtuAlternance = :loginEtuAlternanceTag";
        // Préparation de la requête
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginEtuAlternanceTag" => $loginEtuAlternance
        );
        // On donne les valeurs et on exécute la requête
        $pdoStatement->execute($values);

        $tableau = null;
        foreach ($pdoStatement as $objetFormatTableau) {
            $tableau[] = $this->construireDepuisTableau($objetFormatTableau);
        }
        return $tableau;
    }

    protected function getNomClePrimaire(): string
    {
        return "peutpas";
    }

    protected function getNomTable(): string
    {
        return "Alternance";
    }

    protected function getNomsColones(): array
    {
        return array("loginEtuAlternance",
            "idOffreAlternance");
    }

    // si utiliser reprendre la fonction entière
    public function construireDepuisTableau(array $stageFormatSecretariat) : Alternance {
        $alternance = new Alternance($stageFormatSecretariat['loginEtuAlternance'],$stageFormatSecretariat['idOffreAlternance']);
        return $alternance;
    }

}