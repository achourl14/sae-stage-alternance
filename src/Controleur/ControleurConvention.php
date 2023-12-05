<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Modele\DataObject\ConventionStage;
use App\Modele\HTTP\Session;
use App\Modele\Repository\ConventionStageRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\OffreRepository;

class ControleurConvention extends ControleurGenerique
{

    public static function rechercherConvention()
    {
        $values = null;
        if (isset($_POST["numConvention"]) && $_POST["numConvention"] != "") {
            $values['numConvention'] = $_POST["numConvention"];
        }
        if (isset($_POST["numEtudiant"]) && $_POST["numEtudiant"] != "") {
            $values['numEtudiant'] = $_POST["numEtudiant"];
        }
        if (isset($_POST["prenomEtu"]) && $_POST["prenomEtu"] != "") {
            $values['prenomEtu'] = $_POST["prenomEtu"];
        }
        if (isset($_POST['nomEtu']) && $_POST["nomEtu"] != "") {
            $values['nomEtu'] = $_POST['nomEtu'];
        }
        if (isset($_POST['siret']) && $_POST["siret"] != "") {
            $values['siret'] = $_POST['siret'];
        }

        Session::getInstance()->enregistrer("requeteFiltreConvention", $values);
        self::afficherGestionConvention();
    }

    public static function supprimerFiltreConvention()
    {
        Session::getInstance()->supprimer("requeteFiltreConvention");
        self::afficherGestionConvention();
    }

    public static function afficherGestionConvention(){
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            if (!Session::getInstance()->contient("requeteFiltreConvention")) {
                $conventions = (new ConventionStageRepository())->recuperer();
            } else {
                $conventions = (new ConventionStageRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreConvention"));
            }
            $tableauParPage = null;
            if ($conventions == null) {
                $nbrePages = 1;
                $page = 1;
            } else {

                //Pagination
                $nombresConventions = count($conventions);
                $nbrePages = ceil($nombresConventions / 9);

                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page > $nbrePages) {
                        $page = $nbrePages;
                    } else if ($page <= 1) {
                        $page = 1;
                    }
                }
                $y = $page * 9;
                if ($page * 9 > $nombresConventions) {
                    $y = $nombresConventions;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $conventions[$i];
                }

            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Convention/vueGestionConvention.php", "conventions" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestions des Conventions"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherCreationConvention(){
        if(ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()){
            $offre = null;
            $etudiant = null;
            $entreprise = null;
            if(isset($_GET["login"]) && isset($_GET["idOffre"])){
                $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET["login"]);
                $offre = (new OffreRepository())->recupererParClePrimaire($_GET["idOffre"]);
                $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($offre->getIdOffre());
            }

            self::afficherVue("vueGenerale.php",["contenu" => "Convention/vueConventions.php", "title" => "Créer Convention","etudiant"=> $etudiant, "offre" =>$offre, "entreprise" => $entreprise]);
        }
    }

    public static function creerConvention(){
        $dateDebutInterup = "0000-00-00";
        $dateFinInterup = "0000-00-00";
        if($_POST['dateDebutInterruption'] != ""){
            $dateDebutInterup = $_POST['dateDebutInterruption'];
        }
        if($_POST['dateFinInterruption'] != ""){
            $dateFinInterup = $_POST['dateFinInterruption'];
        }
        $convention = new ConventionStage(
            null,
            $_POST['numEtudiant'],
            $_POST['nomEtu'],
            $_POST['prenomEtu'],
            $_POST['numTelPersoEtu'],
            $_POST['numTelEtu'],
            $_POST['mailPersoEtu'],
            $_POST['mailUniversitaireEtu'],
            $_POST['codeUfr'],
            $_POST['libUfr'],
            $_POST['codeDepartement'],
            $_POST['codeEtape'],
            $_POST['libEtape'],
            $_POST['dateDeDebut'],
            $_POST['dateDeFin'],
            $_POST['interruption'],
            $dateDebutInterup,
            $dateFinInterup,
            $_POST['thematique'],
            $_POST['sujet'],
            $_POST['fonctionTache'],
            $_POST['detailProjet'],
            $_POST['duree'],
            $_POST['nbJourTravail'],
            $_POST['nbHeureHebdomadaire'],
            $_POST['gratification'],
            $_POST['uniteGratification'],
            $_POST['uniteDureeGratification'],
            $_POST['conventionValide'],
            $_POST['nomEnseignantReferent'],
            $_POST['prenomEnseignantReferent'],
            $_POST['mailEnseignantReferent'],
            $_POST['nomSignataire'],
            $_POST['prenomSignataire'],
            $_POST['mailSignataire'],
            $_POST['fonctionSignataire'],
            $_POST['anneeUniversitaire'],
            $_POST['typeDeConvention'],
            $_POST['commentaireStage'],
            $_POST['commentaireDureeTravail'],
            $_POST['codeELP'],
            $_POST['elementPedagogique'],
            $_POST['codeSexeEtu'],
            $_POST['avantageNature'],
            $_POST['adresseEtu'],
            $_POST['codePostalEtu'],
            $_POST['paysEtu'],
            $_POST['villeEtu'],
            $_POST['conventionValidePedagogique'],
            $_POST['avenant'],
            $_POST['detailAvenant'],
            $_POST['dateCreationConvention'],
            $_POST['dateModificationConvention'],
            $_POST['origineStage'],
            $_POST['nomEtablissement'],
            $_POST['siret'],
            $_POST['adresseResidence'],
            $_POST['adresseVoie'],
            $_POST['adresseLibCedex'],
            $_POST['codePostal'],
            $_POST['communeEtabAcceuil'],
            $_POST['paysEtablissement'],
            $_POST['statutJuridique'],
            $_POST['typeStructure'],
            $_POST['effectif'],
            $_POST['codeNAF'],
            $_POST['telEtablissement'],
            $_POST['fax'],
            $_POST['mailEtablissement'],
            $_POST['siteWeb'],
            $_POST['nomServiceAcceuil'],
            $_POST['residenceServiceAcceuil'],
            $_POST['voieServiceAcceuil'],
            $_POST['cedexServiceAcceuil'],
            $_POST['codePostalServiceAcceuil'],
            $_POST['communeServiceAcceuil'],
            $_POST['paysServiceAcceuil'],
            $_POST['nomTuteurProfessionnel'],
            $_POST['prenomTuteurProfessionnel'],
            $_POST['mailTuteurProfessionnel'],
            $_POST['telTuteurProfessionnel'],
            $_POST['fonctionTuteurProfessionnel']);
        (new ConventionStageRepository())->sauvegarderC($convention);
        echo '<div class="msgConfirmation"><p> La Convention a bien été enregistrée </p></div>';
        self::afficherAccueil();
    }

    public static function validerPedagogiqueConvention(){
        if (ConnexionUtilisateur::estMaitreSA()) {
            $convention = (new ConventionStageRepository())->recupererParClePrimaire($_GET['numConvention']);
            ConventionStageRepository::validerConventionPedagogique($convention);
            $msg = "";
            if ($convention->getConventionValidePedagogique() == "Oui") {
                $msg = "invalider";
            } else {
                $msg = "valider";
            }
            echo '<div class="msgConfirmation"><p> Vous avez bien ' . $msg . ' pedagogiquement la convention numéro : ' . $convention->getNumConvention() . '</p></div>';
            self::afficherGestionConvention();
        } else {
            echo '<div class="msgConfirmation"><p>Vous n\'avez pas les droits de valider ou dévalider pédagogiquement des conventions</p></div>';
        }
    }

    public static function validerConvention(){
        if (ConnexionUtilisateur::estSecretariat()) {
            $convention = (new ConventionStageRepository())->recupererParClePrimaire($_GET['numConvention']);
            ConventionStageRepository::validerConvention($convention);
            $msg = "";
            if ($convention->getConventionValide() == "Oui") {
                $msg = "invalider";
            } else {
                $msg = "valider";
            }
            echo '<div class="msgConfirmation"><p> Vous avez bien ' . $msg . ' la convention numéro : ' . $convention->getNumConvention() . '</p></div>';
            self::afficherGestionConvention();
        } else {
            echo '<div class="msgConfirmation"><p>Vous n\'avez pas les droits de valider ou dévalider des conventions</p></div>';
        }
    }
}