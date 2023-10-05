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
    public function __construct(string $nomOffre,int $idEntreprise, string $mission, string $statutAlternance, int $idAlternance, int $validation,int $inOut){
        $this->nomOffre = $nomOffre;
        $this->idEntreprise = $idEntreprise;
        $this->mission = $mission;
        if($inOut == 1){
            self::construct2($idAlternance,$statutAlternance,$validation);
        }
    }

    public function construct2(int $idStage,string $statutStage, int $validation)
    {
        $this->idAlternance = $idStage;
        $this->statutAlternance = $statutStage;
        $this->validationS = $validation;
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
        $offreDeStage = new OffreAlternance($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseAlternance'],$offreFormatTableau['missionAlternance'],$offreFormatTableau['statueAlternance'],$offreFormatTableau['idAlternance'],$offreFormatTableau['ValidationAlternance'],1);
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

        $sql = "INSERT INTO OffreDeAlternance (idEntrepriseAlternance, missionAlternance, nomOffre) VALUES(:idEntrepriseTag, :missionTag, :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $this->idEntreprise,
            "missionTag" => $this->mission,
            "nomOffreTag" => $this->nomOffre
        );
        $pdoStatement->execute($values);
    }
}