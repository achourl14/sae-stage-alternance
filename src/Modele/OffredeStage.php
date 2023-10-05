<?php

namespace App\Modele;

class OffredeStage
{
    private int $idStage;
    private string $nomOffre;
    private int $idEntreprise;
    private string $mission;
    private string $statutStage;
    private int $validation;

    /**
     * @param int $idStage
     * @param int $idEntreprise
     * @param string $mission
     * @param string $statutStage
     * @param int $validation
     */
    public function __construct(string $nomOffre,int $idEntreprise, string $mission, string $statutStage, int $idStage, int $validation,int $inOut){
        $this->nomOffre = $nomOffre;
        $this->idEntreprise = $idEntreprise;
        $this->mission = $mission;
        if($inOut == 1){
            self::construct2($idStage,$statutStage,$validation);
        }
    }

    public function construct2(int $idStage,string $statutStage, int $validation)
    {
        $this->idStage = $idStage;
        $this->statutStage = $statutStage;
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

    public function getStatutStage(): string
    {
        return $this->statutStage;
    }

    public function getValidation(): int
    {
        return $this->validation;
    }

    public function getNomOffre(): string
    {
        return $this->nomOffre;
    }



    public static function construireDepuisTableau(array $offreFormatTableau) : OffredeStage {
        $offreDeStage = new OffredeStage($offreFormatTableau['nomOffre'],$offreFormatTableau['idEntrepriseStage'],$offreFormatTableau['missionStage'],$offreFormatTableau['statueStage'],$offreFormatTableau['idStage'],$offreFormatTableau['ValidationStage'],1);
        return $offreDeStage;
    }

    public static function getOffreDeStage(){
        $pdoStatement =  ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM OffreDeStage");
        foreach($pdoStatement as $offreFormatTableau){
            $tableau[] = self::construireDepuisTableau($offreFormatTableau);
        }
        return $tableau;
    }

    public function sauvegarder() : void {

        $sql = "INSERT INTO OffreDeStage (idEntrepriseStage, missionStage, nomOffre) VALUES (:idEntrepriseTag, :missionTag, :nomOffreTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idEntrepriseTag" => $this->idEntreprise,
            "missionTag" => $this->mission,
            "nomOffreTag" => $this->nomOffre
        );
        $pdoStatement->execute($values);
    }


}