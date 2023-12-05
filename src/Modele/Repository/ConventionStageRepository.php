<?php

namespace App\Modele\Repository;
use App\Modele\DataObject\ConventionStage;

class ConventionStageRepository extends AbstractRepository
{

    public function construireDepuisTableau(array $conventionFormatTableau) : ConventionStage{
        $convention = new ConventionStage(
            $conventionFormatTableau['numConvention'],
            $conventionFormatTableau['numEtudiant'],
            $conventionFormatTableau['nomEtu'],
            $conventionFormatTableau['prenomEtu'],
            $conventionFormatTableau['numTelPersoEtu'],
            $conventionFormatTableau['numTelEtu'],
            $conventionFormatTableau['mailPersoEtu'],
            $conventionFormatTableau['mailUniversitaireEtu'],
            $conventionFormatTableau['codeUfr'],
            $conventionFormatTableau['libUfr'],
            $conventionFormatTableau['codeDepartement'],
            $conventionFormatTableau['codeEtape'],
            $conventionFormatTableau['libEtape'],
            $conventionFormatTableau['dateDebut'],
            $conventionFormatTableau['dateFin'],
            $conventionFormatTableau['interruption'],
            $conventionFormatTableau['dateDebutInterruption'],
            $conventionFormatTableau['dateFinInterruption'],
            $conventionFormatTableau['thematique'],
            $conventionFormatTableau['sujet'],
            $conventionFormatTableau['fonctionTache'],
            $conventionFormatTableau['detailProjet'],
            $conventionFormatTableau['duree'],
            $conventionFormatTableau['nbJourTravail'],
            $conventionFormatTableau['nbHeureHebdomadaire'],
            $conventionFormatTableau['gratification'],
            $conventionFormatTableau['uniteGratification'],
            $conventionFormatTableau['uniteDureGratification'],
            $conventionFormatTableau['conventionValide'],
            $conventionFormatTableau['nomEnseignantReferent'],
            $conventionFormatTableau['prenomEnseignentReferent'],
            $conventionFormatTableau['mailEnseignentReferent'],
            $conventionFormatTableau['nomSignataire'],
            $conventionFormatTableau['prenomSignataire'],
            $conventionFormatTableau['mailSignataire'],
            $conventionFormatTableau['fonctionSignataire'],
            $conventionFormatTableau['anneeUniversitaire'],
            $conventionFormatTableau['typeDeConvention'],
            $conventionFormatTableau['commentaireStage'],
            $conventionFormatTableau['commentaireDureeTravail'],
            $conventionFormatTableau['codeELP'],
            $conventionFormatTableau['elementPedagogique'],
            $conventionFormatTableau['codeSexeEtu'],
            $conventionFormatTableau['avantageNature'],
            $conventionFormatTableau['adresseEtu'],
            $conventionFormatTableau['codePostalEtu'],
            $conventionFormatTableau['paysEtu'],
            $conventionFormatTableau['villeEtu'],
            $conventionFormatTableau['conventionValidePedagogique'],
            $conventionFormatTableau['avenant'],
            $conventionFormatTableau['detailAvenant'],
            $conventionFormatTableau['dateCreationConvention'],
            $conventionFormatTableau['dateModificationConvention'],
            $conventionFormatTableau['origineStage'],
            $conventionFormatTableau['nomEtablissement'],
            $conventionFormatTableau['siret'],
            $conventionFormatTableau['adresseResidence'],
            $conventionFormatTableau['adresseVoie'],
            $conventionFormatTableau['adresseLibCedex'],
            $conventionFormatTableau['codePostal'],
            $conventionFormatTableau['communeEtabAcceuil'],
            $conventionFormatTableau['paysEtablissement'],
            $conventionFormatTableau['statutJuridique'],
            $conventionFormatTableau['typeStructure'],
            $conventionFormatTableau['effectif'],
            $conventionFormatTableau['codeNAF'],
            $conventionFormatTableau['telEtablissement'],
            $conventionFormatTableau['fax'],
            $conventionFormatTableau['mailEtablissement'],
            $conventionFormatTableau['siteWeb'],
            $conventionFormatTableau['nomServiceAcceuil'],
            $conventionFormatTableau['residenceServiceAcceuil'],
            $conventionFormatTableau['voieServiceAcceuil'],
            $conventionFormatTableau['cedexServiceAcceuil'],
            $conventionFormatTableau['codePostalServiceAcceuil'],
            $conventionFormatTableau['communeServiceAcceuil'],
            $conventionFormatTableau['paysServiceAcceuil'],
            $conventionFormatTableau['nomTuteurProfessionnel'],
            $conventionFormatTableau['prenomTuteurProfessionnel'],
            $conventionFormatTableau['mailTuteurProfessionnel'],
            $conventionFormatTableau['telTuteurProfessionnel'],
            $conventionFormatTableau['fonctionTuteurProfessionnel']
        );

        return $convention;
    }

    public function getNomsColones(): array
    {
        return array(
            "numEtudiant",
            "nomEtu",
            "prenomEtu",
            "numTelPersoEtu",
            "numTelEtu",
            "mailPersoEtu",
            "mailUniversitaireEtu",
            "codeUfr",
            "libUfr",
            "codeDepartement",
            "codeEtape",
            "libEtape",
            "dateDebut",
            "dateFin",
            "interruption",
            "dateDebutInterruption",
            "dateFinInterruption",
            "thematique",
            "sujet",
            "fonctionTache",
            "detailProjet",
            "duree",
            "nbJourTravail",
            "nbHeureHebdomadairer",
            "gratification",
            "uniteGratification",
            "uniteDureGratification",
            "conventionValide",
            "nomEnseignantReferent",
            "prenomEnseignentReferent",
            "mailEnseignentReferent",
            "nomSignataire",
            "prenomSignataire",
            "mailSignataire",
            "fonctionSignataire",
            "anneeUniversitaire",
            "typeDeConvention",
            "commentaireStage",
            "commentaireDureeTravail",
            "codeELP",
            "elementPedagogique",
            "codeSexeEtu",
            "avantageNature",
            "adresseEtu",
            "codePostalEtu",
            "paysEtu",
            "villeEtu",
            "conventionValidePedagogique",
            "avenant",
            "detailAvenant",
            "dateCreationConvention",
            "dateModificationConvention",
            "origineStage",
            "nomEtablissement",
            "siret",
            "adresseResidence",
            "adresseVoie",
            "adresseLibCedex",
            "codePostal",
            "communeEtabAcceuil",
            "paysEtablissement",
            "statutJuridique",
            "typeStructure",
            "effectif",
            "codeNAF",
            "telEtablissement",
            "fax",
            "mailEtablissement",
            "siteWeb",
            "nomServiceAcceuil",
            "residenceServiceAcceuil",
            "voieServiceAcceuil",
            "cedexServiceAcceuil",
            "codePostalServiceAcceuil",
            "communeServiceAcceuil",
            "paysServiceAcceuil",
            "nomTuteurProfessionnel",
            "prenomTuteurProfessionnel",
            "mailTuteurProfessionnel",
            "telTuteurProfessionnel",
            "fonctionTuteurProfessionnel"
        );
    }

    public function nbreConventionValidePedagogique(){
        $sql = "SELECT COUNT(numConvention) FROM ConventionStage WHERE conventionValidePedagogique = 'Oui'";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);

        return $pdoStatement->fetchColumn();
    }

    public function nbreConventionNonValidePedagogique(){
        $sql = "SELECT COUNT(numConvention) FROM ConventionStage WHERE conventionValidePedagogique = 'Non'";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);

        return $pdoStatement->fetchColumn();
    }

    public static function validerConventionPedagogique(ConventionStage $conventionStage) : void {

        $sql = "UPDATE ConventionStage SET conventionValidePedagogique = :conventionValidePedagogiqueTag WHERE numConvention = :numConventionTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        if($conventionStage->getConventionValidePedagogique() == "Non"){
            $values = array(
                "conventionValidePedagogiqueTag" => "Oui",
                "numConventionTag" => $conventionStage->getNumConvention()
            );
            $pdoStatement->execute($values);
        }else{
            $values = array(
                "conventionValidePedagogiqueTag" => "Non",
                "numConventionTag" => $conventionStage->getNumConvention()
            );
            $pdoStatement->execute($values);
        }
    }

    public function nbreConventionValide(){
        $sql = "SELECT COUNT(numConvention) FROM ConventionStage WHERE conventionValide = 'Oui'";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);

        return $pdoStatement->fetchColumn();
    }

    public function nbreConventionNonValide(){
        $sql = "SELECT COUNT(numConvention) FROM ConventionStage WHERE conventionValide = 'Non'";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query($sql);

        return $pdoStatement->fetchColumn();
    }

    public static function validerConvention(ConventionStage $conventionStage) : void {

        $sql = "UPDATE ConventionStage SET conventionValide = :conventionValideTag WHERE numConvention = :numConventionTag";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);
        if($conventionStage->getConventionValide() == "Non"){
            $values = array(
                "conventionValideTag" => "Oui",
                "numConventionTag" => $conventionStage->getNumConvention()
            );
            $pdoStatement->execute($values);
        }else{
            $values = array(
                "conventionValideTag" => "Non",
                "numConventionTag" => $conventionStage->getNumConvention()
            );
            $pdoStatement->execute($values);
        }
    }


    protected function getNomTable(): string
    {
        return "ConventionStage";
    }

    public function getNomClePrimaire(): string
    {
        return "numConvention";
    }

}