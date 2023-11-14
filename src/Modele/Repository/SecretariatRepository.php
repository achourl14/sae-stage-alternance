<?php

namespace App\Modele\Repository;
use App\Modele\DataObject\Secretariat;

class SecretariatRepository extends AbstractRepository
{

    public static function sauvegarder(Secretariat $secretariat) : void {
        $sql = "INSERT INTO Secretariat VALUES(:idSecretariatTag, :prenomSecretariatTag, :nomSecretariatTag, :motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "idSecretariatTag" => $secretariat->getIdSecretariat(),
            "prenomSecretariatTag" => $secretariat->getPrenomSecretariat(),
            "nomSecretariatTag" => $secretariat->getNomSecretariat(),
            "motDePasseTag" => $secretariat->getMdp()
        );

        $pdoStatement->execute($values);
    }
    public function construireDepuisTableau(array $secretariatFormatTableau) : Secretariat {
        $secretariat = new Secretariat($secretariatFormatTableau['idSecretariat'],$secretariatFormatTableau['nomSecretariat'],$secretariatFormatTableau['prenomSecretariat'],$secretariatFormatTableau['mdp']);
        return $secretariat;
    }

    protected function getNomTable(): string
    {
        return "Secretariat";
    }

    protected function getNomClePrimaire(): string
    {
        return "idSecretariat";
    }

    protected function getNomsColones(): array
    {
        return array(
            "idSecretariat",
            "nomSecretariat",
            "prenomSecretariat",
            "mdp"
        );
    }


}