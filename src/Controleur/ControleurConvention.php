<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\ConventionAlternance;
use App\Modele\DataObject\ConventionStage;
use App\Modele\DataObject\Entreprise;
use App\Modele\HTTP\Session;
use App\Modele\Repository\ConventionAlternanceRepository;
use App\Modele\Repository\ConventionStageFinaleRepository;
use App\Modele\Repository\ConventionStageRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\OffreRepository;

class ControleurConvention extends ControleurGenerique
{

    //Brouillon Convention

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

    public static function afficherGestionConvention()
    {
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

    public static function afficherCreationConvention()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estEtudiant()) {
            $offre = null;
            $etudiant = null;
            $entreprise = null;
            if (isset($_GET["login"]) && isset($_GET["idOffre"])) {
                $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET["login"]);
                $offre = (new OffreRepository())->recupererParClePrimaire($_GET["idOffre"]);
                $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise());
            }

            self::afficherVue("vueGenerale.php", ["contenu" => "Convention/vueConventions.php", "title" => "Créer Convention", "etudiant" => $etudiant, "offre" => $offre, "entreprise" => $entreprise]);
        }
    }

    public static function creerConvention()
    {

        $dateDebutInterup = "0000-00-00";
        $dateFinInterup = "0000-00-00";
        if ($_POST['dateDebutInterruption'] != "") {
            $dateDebutInterup = $_POST['dateDebutInterruption'];
        }
        if ($_POST['dateFinInterruption'] != "") {
            $dateFinInterup = $_POST['dateFinInterruption'];
        }

        $dateCreationConvention = date("Y-m-d", time());
        $dateModificationConvention = date("Y-m-d", time());
        if ($_POST['dateCreationConvention'] != "") {
            $dateCreationConvention = $_POST['dateCreationConvention'];
        }
        if ($_POST['dateModificationConvention'] != "") {
            $dateModificationConvention = $_POST['dateModificationConvention'];
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
            $dateCreationConvention,
            $dateModificationConvention,
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

    public static function validerPedagogiqueConvention()
    {
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

    public static function validerConvention()
    {
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

    public static function afficherMAJConvention()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            $convention = (new ConventionStageRepository())->recupererParClePrimaire($_GET['numConvention']);
            self::afficherVue("vueGenerale.php", ["contenu" => "CreationConvention/vueConventionEtudiant.php", "title" => "Mise à jour Convention", "convention" => $convention]);
        }
    }

    public static function afficherMAJConventionDepuisEtudiant()
    {
        if (ConnexionUtilisateur::estEtudiant()) {
            $etudiant = (new EtudiantRepository())->recupererParClePrimaire(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            $convention = (new ConventionStageRepository())->recupererDepuisNumEtudiant($etudiant->getNumEtudiant());
            if ($convention == null) {
                self::afficherErreur("Vous n'avez pas de convention");
            } else {
                self::afficherVue("vueGenerale.php", ["contenu" => "CreationConvention/vueConventionEtudiant.php", "title" => "Mise à jour Convention", "convention" => $convention]);
            }

        }
    }

    public static function afficherDetailConvention()
    {
        if (!isset($_GET["numConvention"])) {
            self::afficherErreur("L'id de la convention n'est pas renseigné");
        } else {
            $convention = (new ConventionStageRepository())->recupererParClePrimaire($_GET["numConvention"]);
            $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($convention->getSiret());
            $etudiant = (new EtudiantRepository())->recupererDepuisNumEtudiant($convention->getNumEtudiant());
            self::afficherVue("vueGenerale.php", ["title" => "Detail Convention ", "contenu" => "Convention/vueDetailConvention.php", "convention" => $convention, "entreprise" => $entreprise, "etudiant" => $etudiant]);
        }
    }

    public static function MAJConvention()
    {
        $dateDebutInterup = "0000-00-00";
        $dateFinInterup = "0000-00-00";
        if ($_POST['dateDebutInterruption'] != "") {
            $dateDebutInterup = $_POST['dateDebutInterruption'];
        }
        if ($_POST['dateFinInterruption'] != "") {
            $dateFinInterup = $_POST['dateFinInterruption'];
        }
        $convention = new ConventionStage(
            $_POST['numConvention'],
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
        (new ConventionStageRepository())->mettreAJour($convention);
        self::afficherErreur("Les informations de votre entreprise " . $convention->getNumConvention() . " ont bien été mis à jour");

    }

    //Convention Finale

    public static function afficherGestionConventionFinale()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            if (!Session::getInstance()->contient("requeteFiltreConventionFinale")) {
                $conventions = (new ConventionStageFinaleRepository())->recuperer();
            } else {
                $conventions = (new ConventionStageFinaleRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreConventionFinale"));
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
            self::afficherVue("vueGenerale.php", ["contenu" => "ConventionFinale/vueGestionConvention.php", "conventions" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Conventions Finale"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailConventionFinale()
    {
        if (!isset($_GET["numConvention"])) {
            self::afficherErreur("L'id de la convention n'est pas renseigné");
        } else {
            $convention = (new ConventionStageFinaleRepository())->recupererParClePrimaire($_GET["numConvention"]);
            $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($convention->getSiret());
            $etudiant = (new EtudiantRepository())->recupererDepuisNumEtudiant($convention->getNumEtudiant());
            self::afficherVue("vueGenerale.php", ["title" => "Detail Convention ", "contenu" => "Convention/vueDetailConvention.php", "convention" => $convention, "entreprise" => $entreprise, "etudiant" => $etudiant]);
        }
    }

    public static function rechercherConventionFinale()
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

        Session::getInstance()->enregistrer("requeteFiltreConventionFinale", $values);
        self::afficherGestionConvention();
    }

    public static function supprimerFiltreConventionFinale()
    {
        Session::getInstance()->supprimer("requeteFiltreConventionFinale");
        self::afficherGestionConvention();
    }

    public static function afficherVueImportationConventionFinale()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "ConventionFinale/vueImportationConventionFinale.php", "title" => "Importation Convention Finale"]);
        }
    }

    public static function importerConvention()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            if ($_FILES["fileToUpload"]["name"]) {
                $nomFichier = $_FILES["fileToUpload"]["name"];
                $dossier = $_FILES["fileToUpload"]["tmp_name"];
                move_uploaded_file("$dossier", "../fichier_csv/$nomFichier");
                $file_parts = pathinfo("../fichier_csv/$nomFichier");
                if ($file_parts['extension'] != "csv") {
                    echo '<div class="msgErreur"><p>Le fichier n\'est pas un fichier CSV</p></div>';
                    self::afficherGestionConvention();
                } else {
                    $file = fopen("../fichier_csv/$nomFichier", "r");
                    fgetcsv($file);
                    while (($data = fgetcsv($file, 1000, ",")) !== false) {

                        if((new ConventionStageFinaleRepository())->recupererParClePrimaire($data[0]) != null){
                            echo '<div class="msgConfirmation"><p>La convention numéro : '.$data[0].' existe déjà</p></div>';
                            self::afficherGestionConventionFinale();
                        }else{
                            $dateDebut = date("Y-m-d", strtotime($data[13]));
                            $dateFin = date("Y-m-d", strtotime($data[14]));

                            $dateDebutI = date("Y-m-d", strtotime($data[16]));
                            $dateFinI = date("Y-m-d", strtotime($data[17]));

                            $dateCreation = date("Y-m-d", strtotime($data[51]));
                            $dateModification = date("Y-m-d", strtotime($data[52]));
                            $convention = new ConventionStage(
                                $data[0],
                                $data[1],
                                $data[2],
                                $data[3],
                                $data[4],
                                $data[5],
                                $data[6],
                                $data[7],
                                $data[8],
                                $data[9],
                                $data[10],
                                $data[11],
                                $data[12],
                                $dateDebut,
                                $dateFin,
                                $data[15],
                                $dateDebutI,
                                $dateFinI,
                                $data[18],
                                $data[19],
                                $data[20],
                                $data[21],
                                $data[22],
                                $data[23],
                                $data[24],
                                $data[25],
                                $data[26],
                                $data[27],
                                $data[28],
                                $data[29],
                                $data[30],
                                $data[31],
                                $data[32],
                                $data[33],
                                $data[34],
                                $data[35],
                                $data[36],
                                $data[37],
                                $data[38],
                                $data[39],
                                $data[40],
                                $data[41],
                                $data[42],
                                $data[43],
                                $data[44],
                                $data[45],
                                $data[46],
                                $data[47],
                                $data[48],
                                $data[49],
                                $data[50],
                                $dateCreation,
                                $dateModification,
                                $data[53],
                                $data[54],
                                $data[55],
                                $data[56],
                                $data[57],
                                $data[58],
                                $data[59],
                                $data[60],
                                $data[61],
                                $data[62],
                                $data[63],
                                $data[64],
                                $data[65],
                                $data[66],
                                $data[67],
                                $data[68],
                                $data[69],
                                $data[70],
                                $data[71],
                                $data[72],
                                $data[73],
                                $data[74],
                                $data[75],
                                $data[76],
                                $data[77],
                                $data[78],
                                $data[79],
                                $data[80],
                                $data[81]
                            );
                            fclose($file);
                            (new ConventionStageFinaleRepository())->sauvegarderC($convention);
                            unlink("../fichier_csv/$nomFichier");
                            echo '<div class="msgErreur"><p>L\'importation a été un succès</p></div>';
                            self::afficherGestionConventionFinale();
                        }
                    }
                }

            }
        }
    }

    //CONVENTION ALTERNANCE FINALE

    public static function afficherGestionConventionAlternanceFinale()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            if (!Session::getInstance()->contient("requeteFiltreConventionAlternanceFinale")) {
                $conventions = (new ConventionAlternanceRepository())->recuperer();
            } else {
                $conventions = (new ConventionAlternanceRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreConventionAlternanceFinale"));
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
            self::afficherVue("vueGenerale.php", ["contenu" => "ConventionFinale/vueGestionConventionAlternance.php", "conventions" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Conventions Alternance Finale"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

//    public static function afficherDetailConventionAlternanceFinale()
//    {
//        if (!isset($_GET["id"])) {
//            self::afficherErreur("L'id de la convention n'est pas renseigné");
//        } else {
//            $convention = (new ConventionAlternanceRepository())->recupererParClePrimaire($_GET["id"]);
//            $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($convention->getSiret());
//            $etudiant = (new EtudiantRepository())->recupererDepuisNumEtudiant($convention->getNumEtudiant());
//            self::afficherVue("vueGenerale.php", ["title" => "Detail Convention ", "contenu" => "Convention/vueDetailConventionAlternance.php", "convention" => $convention, "entreprise" => $entreprise, "etudiant" => $etudiant]);
//        }
//    }

    public static function rechercherConventionAlternanceFinale()
    {
        $values = null;
        if (isset($_POST["id"]) && $_POST["id"] != "") {
            $values['id'] = $_POST["id"];
        }
        if (isset($_POST["prenomAlternantEtu"]) && $_POST["prenomAlternantEtu"] != "") {
            $values['prenomAlternantEtu'] = $_POST["prenomAlternantEtu"];
        }
        if (isset($_POST['nomAlternantEtu']) && $_POST["nomAlternantEtu"] != "") {
            $values['nomAlternantEtu'] = $_POST['nomAlternantEtu'];
        }
        if (isset($_POST['siret']) && $_POST["siret"] != "") {
            $values['siret'] = $_POST['siret'];
        }

        Session::getInstance()->enregistrer("requeteFiltreConventionAlternanceFinale", $values);
        self::afficherGestionConvention();
    }

    public static function supprimerFiltreConventionAlternanceFinale()
    {
        Session::getInstance()->supprimer("requeteFiltreConventionAlternanceFinale");
        self::afficherGestionConvention();
    }

    public static function afficherVueImportationConventionAlternanceFinale()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "ConventionFinale/vueImportationConventionAlternanceFinale.php", "title" => "Importation Convention Alternance Finale"]);
        }
    }

    public static function importerConventionAlternance()
    {
        if (ConnexionUtilisateur::estMaitreSA() || ConnexionUtilisateur::estSecretariat()) {
            if ($_FILES["fileToUpload"]["name"]) {
                $nomFichier = $_FILES["fileToUpload"]["name"];
                $dossier = $_FILES["fileToUpload"]["tmp_name"];
                move_uploaded_file("$dossier", "../fichier_csv/$nomFichier");
                $file_parts = pathinfo("../fichier_csv/$nomFichier");
                if ($file_parts['extension'] != "csv") {
                    echo '<div class="msgErreur"><p>Le fichier n\'est pas un fichier CSV</p></div>';
                    self::afficherGestionConvention();
                } else {
                    $file = fopen("../fichier_csv/$nomFichier", "r");
                    fgetcsv($file);
                    while (($data = fgetcsv($file, 1000, ",")) !== false) {

                        if((new ConventionAlternanceRepository())->recupererParClePrimaire($data[3]) != null){
                            echo '<div class="msgConfirmation"><p>La convention numéro : '.$data[3].' existe déjà</p></div>';
                            self::afficherGestionConventionFinale();
                        }else{
                            $convention = new ConventionAlternance(
                                $data[0],
                                $data[1],
                                $data[2],
                                $data[3],
                                $data[4],
                                $data[5],
                                $data[6],
                                $data[7],
                                $data[8],
                                $data[9],
                                $data[10],
                                $data[11],
                                $data[12],
                                $data[13],
                                $data[14],
                                $data[15],
                                $data[16],
                                $data[17],
                                $data[18],
                                $data[19],
                                $data[20],
                                $data[21],
                                $data[22],
                                $data[23],
                                $data[24],
                                $data[25],
                                $data[26],
                                $data[27],
                                $data[28],
                                $data[29],
                                $data[30],
                                $data[31],
                                $data[32],
                                $data[33],
                                $data[34],
                                $data[35],
                                $data[36],
                                $data[37],
                                $data[38],
                                $data[39],
                                $data[40],
                                $data[41],
                                $data[42],
                                $data[43],
                                $data[44],
                                $data[45],
                                $data[46],
                                $data[47],
                                $data[48],
                                $data[49],
                                $data[50],
                                $data[51],
                                $data[52],
                                $data[53],
                                $data[54],
                                $data[55],
                                $data[56],
                                $data[57],
                                $data[58],
                                $data[59],
                                $data[60],
                                $data[61],
                                $data[62],
                                $data[63],
                                $data[64],
                                $data[65],
                                $data[66],
                                $data[67],
                                $data[68],
                                $data[69],
                                $data[70],
                                $data[71],
                                $data[72],
                                $data[73],
                                $data[74],
                                $data[75],
                                $data[76],
                                $data[77],
                                $data[78],
                                $data[79],
                                $data[80],
                                $data[81],
                                $data[82],
                                $data[83],
                                $data[84],
                                $data[85],
                                $data[86],
                                $data[87],
                                $data[88],
                                $data[89],
                                $data[90],
                                $data[91],
                                $data[92],
                                $data[93],
                                $data[94],
                                $data[95],
                                $data[96],
                                $data[97],
                                $data[98],
                                $data[99],
                                $data[100],
                                $data[101],
                                $data[102],
                                $data[103],
                                $data[104],
                                $data[105],
                                $data[106],
                                $data[107],
                                $data[108],
                                $data[109],
                                $data[110],
                                $data[111],
                                $data[112],
                                $data[113],
                                $data[114],
                                $data[115],
                                $data[116],
                                $data[117],
                                $data[118],
                                $data[119],
                                $data[120],
                                $data[121],
                                $data[122],
                                $data[123],
                                $data[124],
                                $data[125],
                                $data[126],
                                $data[127],
                                $data[128],
                                $data[129],
                                $data[130],
                                $data[131],
                                $data[132],
                                $data[133],
                                $data[134],
                                $data[135],
                                $data[136],
                                $data[137],
                                $data[138],
                                $data[139],
                                $data[140],
                                $data[141],
                                $data[142]
                            );
                            fclose($file);
                            (new ConventionAlternanceRepository())->sauvegarder($convention);
                            unlink("../fichier_csv/$nomFichier");
                            echo '<div class="msgErreur"><p>L\'importation a été un succès</p></div>';
                            self::afficherGestionConventionAlternanceFinale();
                        }
                    }
                }

            }
        }
    }

    public static function MiseAJourConventionEtudiant(){
        $convention = (new ConventionStageRepository())->recupererParClePrimaire($_POST['numConvention']);
        $convention->setNumEtudiant($_POST['numEtudiant']);
        $convention->setNomEtu($_POST['nomEtu']);
        $convention->setPrenomEtu($_POST['prenomEtu']);
        $convention->setNumTelPersoEtu($_POST['numTelPersoEtu']);
        $convention->setNumTelEtu($_POST['numTelEtu']);
        $convention->setMailPersoEtu($_POST['mailPersoEtu']);
        $convention->setMailUniversitaireEtu($_POST['mailUniversitaireEtu']);
        $convention->setMailPersoEtu($_POST['mailPersoEtu']);
        $convention->setCodeSexeEtu($_POST['codeSexeEtu']);
        $convention->setAdresseEtu($_POST['adresseEtu']);
        $convention->setCodePostalEtu($_POST['codePostalEtu']);
        $convention->setVilleEtu($_POST['villeEtu']);
        $convention->setPaysEtu($_POST['paysEtu']);
        $convention->setCodeUfr($_POST['codeUfr']);
        $convention->setLibUfr($_POST['libUfr']);
        $convention->setCodeDepartement($_POST['codeDepartement']);
        $convention->setCodeEtape($_POST['codeEtape']);
        $convention->setLibEtape($_POST['libEtape']);
        (new ConventionStageRepository())->mettreAJour($convention);
        self::afficherVue("vueGenerale.php", ["contenu" => "CreationConvention/vueConventionEntreprise.php", "title" => "Mise à jour Convention Entreprise", "convention" => $convention]);
    }
    public static function MiseAJourConventionEntreprise(){
        $convention = (new ConventionStageRepository())->recupererParClePrimaire($_POST['numConvention']);
        $convention->setNomEtablissement($_POST['nomEtablissement']);
        $convention->setSiret($_POST['siret']);
        $convention->setAdresseResidence($_POST['adresseResidence']);
        $convention->setAdresseVoie($_POST['adresseVoie']);
        $convention->setAdresseLibCedex($_POST['adresseLibCedex']);
        $convention->setCodePostal($_POST['codePostal']);
        $convention->setCommuneEtabAcceuil($_POST['communeEtabAcceuil']);
        $convention->setPaysEtablissement($_POST['paysEtablissement']);
        $convention->setStatutJuridique($_POST['statutJuridique']);
        $convention->setTypeStructure($_POST['typeStructure']);
        $convention->setEffectif($_POST['effectif']);
        $convention->setCodeNAF($_POST['codeNAF']);
        $convention->setTelEtablissement($_POST['telEtablissement']);
        $convention->setFax($_POST['fax']);
        $convention->setMailEtablissement($_POST['mailEtablissement']);
        $convention->setSiteWeb($_POST['siteWeb']);
        $convention->setNomServiceAcceuil($_POST['nomServiceAcceuil']);
        $convention->setResidenceServiceAcceuil($_POST['residenceServiceAcceuil']);
        $convention->setVoieServiceAcceuil($_POST['voieServiceAcceuil']);
        $convention->setCedexServiceAcceuil($_POST['cedexServiceAcceuil']);
        $convention->setCodePostalServiceAcceuil($_POST['codePostalServiceAcceuil']);
        $convention->setCommuneServiceAcceuil($_POST['communeServiceAcceuil']);
        $convention->setPaysServiceAcceuil($_POST['paysServiceAcceuil']);
        $convention->setNomTuteurProfessionnel($_POST['nomTuteurProfessionnel']);
        $convention->setPrenomTuteurProfessionnel($_POST['prenomTuteurProfessionnel']);
        $convention->setMailTuteurProfessionnel($_POST['mailTuteurProfessionnel']);
        $convention->setTelTuteurProfessionnel($_POST['telTuteurProfessionnel']);
        $convention->setFonctionTuteurProfessionnel($_POST['fonctionTuteurProfessionnel']);


        (new ConventionStageRepository())->mettreAJour($convention);
        self::afficherVue("vueGenerale.php", ["contenu" => "CreationConvention/vueConventionDetailsStage.php", "title" => "Mise à jour Convention Entreprise", "convention" => $convention]);
    }

    public static function MiseAJourConventionDetailStage(){
        $convention = (new ConventionStageRepository())->recupererParClePrimaire($_POST['numConvention']);
        $convention->setDateDebut($_POST['dateDeDebut']);
        $convention->setDateFin($_POST['dateDeFin']);
        $convention->setInterruption($_POST['interruption']);
        $convention->setDateDebutInterruption($_POST['dateDebutInterruption']);
        $convention->setDateFinInterruption($_POST['dateFinInterruption']);
        $convention->setThematique($_POST['thematique']);
        $convention->setSujet($_POST['sujet']);
        $convention->setFonctionTache($_POST['fonctionTache']);
        $convention->setDetailProjet($_POST['detailProjet']);
        $convention->setDuree($_POST['duree']);
        $convention->setNbJourTravail($_POST['nbJourTravail']);
        $convention->setNbHeureHebdomadairer($_POST['nbHeureHebdomadaire']);
        $convention->setGratification($_POST['gratification']);
        $convention->setUniteGratification($_POST['uniteGratification']);
        $convention->setUniteDureGratification($_POST['uniteDureeGratification']);
        $convention->setAnneeUniversitaire($_POST['anneeUniversitaire']);
        $convention->setTypeDeConvention($_POST['typeDeConvention']);
        $convention->setCommentaireStage($_POST['commentaireStage']);
        $convention->setCommentaireDureeTravail($_POST['commentaireDureeTravail']);
        $convention->setAvantageNature($_POST['avantageNature']);
        $convention->setDateCreationConvention($_POST['dateCreationConvention']);
        $convention->setDateModificationConvention($_POST['teModificationConvention']);
        $convention->setOrigineStage($_POST['origineStage']);

        (new ConventionStageRepository())->mettreAJour($convention);
        self::afficherVue("vueGenerale.php", ["contenu" => "CreationConvention/vueConventionAutres.php", "title" => "Mise à jour Convention Entreprise", "convention" => $convention]);
    }

    public static function MiseAJourConventionAutres(){
        $convention = (new ConventionStageRepository())->recupererParClePrimaire($_POST['numConvention']);
        $convention->setAvenant($_POST['avenant']);
        $convention->setDetailAvenant($_POST['detailAvenant']);
        $convention->setNomEnseignantReferent($_POST['nomEnseignantReferent']);
        $convention->setPrenomEnseignentReferent($_POST['prenomEnseignantReferent']);
        $convention->setMailEnseignentReferent($_POST['mailEnseignantReferent']);
        $convention->setNomSignataire($_POST['nomSignataire']);
        $convention->setPrenomSignataire($_POST['prenomSignataire']);
        $convention->setMailSignataire($_POST['mailSignataire']);
        $convention->setFonctionSignataire($_POST['fonctionSignataire']);
        $convention->setCodeELP($_POST['codeELP']);
        $convention->setElementPedagogique($_POST['elementPedagogique']);


        (new ConventionStageRepository())->mettreAJour($convention);
        self::afficherVue("vueGenerale.php", ["contenu" => "CreationConvention/vueConventionAutres.php", "title" => "Mise à jour Convention Entreprise", "convention" => $convention]);
    }

}