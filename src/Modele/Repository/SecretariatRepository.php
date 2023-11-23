<?php

namespace App\Modele\Repository;
use App\Modele\DataObject\Secretariat;

class SecretariatRepository extends AbstractRepository
{

    public static function sauvegarder(Secretariat $secretariat) : void {
        $sql = "INSERT INTO Secretariat VALUES(:loginTag, :prenomSecretariatTag, :nomSecretariatTag,:mailTag,:telephoneTag,:dateDeNaissanceTag,:roleTag ,:motDePasseTag)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "loginTag" => $secretariat->getLogin(),
            "prenomSecretariatTag" => $secretariat->getPrenomSecretariat(),
            "nomSecretariatTag" => $secretariat->getNomSecretariat(),
            "mailTag" => $secretariat->getMail(),
            "telephoneTag" => $secretariat->getTelephone(),
            "dateDeNaissanceTag" => $secretariat->getDateDeNaissance(),
            "roleTag" => $secretariat->getRole(),
            "motDePasseTag" => $secretariat->getMdp()
        );

        $pdoStatement->execute($values);
    }
    public function construireDepuisTableau(array $secretariatFormatTableau) : Secretariat {
        $secretariat = new Secretariat($secretariatFormatTableau['login'],$secretariatFormatTableau['nomSecretariat'],$secretariatFormatTableau['prenomSecretariat'],$secretariatFormatTableau["adresseMail"],$secretariatFormatTableau["telephone"],$secretariatFormatTableau["dateDeNaissance"],$secretariatFormatTableau["role"],$secretariatFormatTableau['mdp']);
        return $secretariat;
    }

    protected function getNomTable(): string
    {
        return "Secretariat";
    }

    public function getNomClePrimaire(): string
    {
        return "login";
    }

    public function getNomsColones(): array
    {
        return array(
            "nomSecretariat",
            "prenomSecretariat",
            "adresseMail",
            "telephone",
            "dateDeNaissance",
            "role",
            "mdp"
        );
    }


}