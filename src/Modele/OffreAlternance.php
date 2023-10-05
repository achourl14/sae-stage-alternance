<?php

namespace App\Modele;

class OffreAlternance
{
    private int $idAlternance;
    private string $nomOffre;
    private int $idEntreprise;
    private string $mission;
    private string $statutAlternance;
    private int $validation;

    /**
     * @param int $idAlternant
     * @param int $idEntreprise
     * @param string $mission
     * @param string $statutStage
     * @param int $validation
     */
    public function __construct(int $idAlternance, string $nomOffre, int $idEntreprise, string $mission, string $statutAlternance, int $validation)
    {
        $this->idAlternance = $idAlternance;
        $this->nomOffre = $nomOffre;
        $this->idEntreprise = $idEntreprise;
        $this->mission = $mission;
        $this->statutAlternance = $statutAlternance;
        $this->validation = $validation;
    }

    public function getIdStage(): int
    {
        return $this->idStage;
    }

    public function getIdEntreprise(): int
    {
        return $this->idEntreprise;
    }

    public function getMission(): string
    {
        return $this->mission;
    }

    public function getStatutAlternance(): string
    {
        return $this->statutAlternance;
    }

    public function getValidation(): int
    {
        return $this->validation;
    }

    public function getNomOffre(): string
    {
        return $this->nomOffre;
    }



    public static function construireDepuisTableau(array $offreFormatTableau) : OffreAlternance {
        $offreDeStage = new OffreAlternance($offreFormatTableau['idAlternance'],$offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseAlternance'],$offreFormatTableau['missionAlternance'],$offreFormatTableau['statueAlternance'],$offreFormatTableau['ValidationAlternance']);
        return $offreDeStage;
    }

    public static function getOffreAlternance(){
        $pdoStatement =  ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM OffreDeAlternance");
        foreach($pdoStatement as $offreFormatTableau){
            $tableau[] = self::construireDepuisTableau($offreFormatTableau);
        }
        return $tableau;
    }

    public function sauvegarder() : void {

        $sql = "INSERT INTO OffreAlternance (idEntrepriseAlternance, missionAlternance, nomOffre) VALUES(:idEntrepriseTag :missionTag :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $this->idEntreprise,
            "missionTag" => $this->mission,
            "nomOffreTag" => $this->nomOffre
        );
        $pdoStatement->execute($values);
    }
}