<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Modele\DataObject\Offre;
use App\Modele\HTTP\Session;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\OffreRepository;
use App\Modele\Repository\PostulerRepository;
use App\Modele\Repository\StageRepository;
use DateTime;

class ControleurOffre extends ControleurGenerique
{

    public static function offres()
    {
        if(ConnexionUtilisateur::estConnecte()){
            if(ConnexionUtilisateur::estEntreprise()){
                $values["idEntreprise"] = ConnexionUtilisateur::getLoginUtilisateurConnecte();
                $offres = (new OffreRepository())->recupererAvecFiltre($values);
            }else{
                if (!Session::getInstance()->contient("requeteFiltreOffre")) {
                    if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
                        $offres = (new OffreRepository())->recuperer();
                    } else {
                        $offres = (new OffreRepository())->recupererOffreValide();
                    }
                } else {
                    $offres = (new OffreRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreOffre"));
                }
            }


            if ($offres == null) {
                echo '<div class="msgConfirmation"><p>Aucune offres disponible, veuillez revenir plus tard</p></div>';
                self::afficherAccueil();
            } else {
                foreach ($offres as $offreFormatTableau) {
                    $tableauTout[] = $offreFormatTableau;
                }

                $tableauParPage = null;

                //Pagination
                $nombresOffre = count($offres);
                $nbrePages = ceil($nombresOffre / 9);

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
                if ($page * 9 > $nombresOffre) {
                    $y = $nombresOffre;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $tableauTout[$i];
                }
                $title = "Liste des offres";
                if(ConnexionUtilisateur::estMaitreSA()){
                    $title = "Gestions des offres";
                }

                self::afficherVue("vueGenerale.php", ["contenu" => "Offre/vueOffres.php", "offreses" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => $title]);
            }
        }else{
            echo '<div class="msgConfirmation"><p>Vous n\'avez pas les droits</p></div>';
            self::afficherAccueil();
        }
    }


    public static function validerOffre()
    {
        if (ConnexionUtilisateur::estMaitreSA()) {
            $offre = (new OffreRepository())->recupererParClePrimaire($_GET['id']);
            OffreRepository::validerOffre($offre);
            $msg = "";
            if ($offre->getValidation()) {
                $msg = "invalider";
            } else {
                $msg = "valider";
            }
            echo '<div class="msgConfirmation"><p> Vous avez bien ' . $msg . ' l\'offre de Stage : ' . $offre->getNomOffre() . '</p></div>';
            self::offres();
        } else {
            echo '<div class="msgConfirmation"><p>Vous n\'avez pas les droits de valider ou dévalider les offres</p></div>';
        }
    }

    public static function creerOffre()
    {
        if($_FILES["fileToUpload"]["name"]){
            $nomFichier = $_FILES["fileToUpload"]["name"];
            $dossier = $_FILES["fileToUpload"]["tmp_name"];
            move_uploaded_file("$dossier", "../upload_offres/$nomFichier");
            $file_parts = pathinfo("../upload_offres/$nomFichier");
            if ($file_parts['extension'] != "pdf" && $file_parts['extension'] != "docx" && $file_parts['extension'] != "txt") {
                unlink("../upload_offres/$nomFichier");
                echo '<div class="msgConfirmation"><p> Impossible de créer l\'offre : Le fichier n\'est pas dans les extensions demandées (.pdf, .docx, .txt)</p></div>';
            }else{
                $offre = null;
                $offre = new Offre(-9, $_POST["idEntreprise"], $_POST["adresseDeOffre"],$_POST["ville"],$_POST["codePostal"],$_POST["nomOffre"],$_POST["mission"], -9, -9, $_POST["dateDebut"], $_POST["dateFin"], $_POST["remuneration"], $_POST["but_annee"], $_POST["parcours"], $_POST["type"], 0);
                OffreRepository::sauvegarder($offre);


                $offreCree = (new OffreRepository())->derniereOffre();
                rename("../upload_offres/$nomFichier", "../upload_offres/offre_" . $offreCree->getIdOffre() . "." . $file_parts['extension']);

                echo '<div class="msgConfirmation"><p> Vous avez bien créer votre offre : ' . $offre->getNomOffre() . '</p></div>';
            }
        }else{
            $offre = null;
            $offre = new Offre(-9, $_POST["idEntreprise"], $_POST["adresseDeOffre"],$_POST["ville"],$_POST["codePostal"], $_POST["nomOffre"], $_POST["mission"], -9, -9, $_POST["dateDebut"], $_POST["dateFin"], $_POST["remuneration"], $_POST["but_annee"], $_POST["parcours"], $_POST["type"], 0);
            OffreRepository::sauvegarder($offre);
            echo '<div class="msgConfirmation"><p> Vous avez bien créer votre offre : ' . $offre->getNomOffre() . '</p></div>';
        }
        self::offres();
    }

    public static function filtrer()
    {
        $type = null;
        $values = null;
        if(isset($_POST['Stage']) && isset($_POST['Alternance']) && isset($_POST["StageAlternance"]) || !isset($_POST['Stage']) && !isset($_POST['Alternance']) && !isset($_POST["StageAlternance"]) ){
            $type = null;
        }else{
            if (isset($_POST['Stage'])) {
                $type[] = "S";
            }
            if (isset($_POST['Alternance'])) {
                $type[] = "A";
            }
            if (isset($_POST['StageAlternance'])) {
                $type[] = "SA";
            }
            $values["type"] = $type;
        }
        if(isset($_POST['Avalider']) && isset($_POST['Valider'])){

        }else if(isset($_POST['Avalider']) || isset($_POST['Valider'])) {
            if (isset($_POST['Valider'])) {
                $validation = 1;
                $values["validation"] = $validation;
            }
            if (isset($_POST['Avalider'])) {
                $validation = 0;
                $values["validation"] = $validation;
            }

        }

        if(isset($_POST['nosOffres'])){
            $values["idEntreprise"] = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        }


        if (isset($_POST["idEntreprise"]) && $_POST["idEntreprise"] != "") {
            $values['idEntreprise'] = $_POST["idEntreprise"];
        }
        if (isset($_POST["nomOffre"]) && $_POST["nomOffre"] != "") {
            $values['nomOffre'] = $_POST["nomOffre"];
        }
        if (isset($_POST["remuneration"]) && $_POST["remuneration"] != "") {
            $values['remuneration'] = $_POST["remuneration"];
        }
        if (isset($_POST['but_annee']) && $_POST["but_annee"] != "") {
            $values['but_annee'] = $_POST['but_annee'];
        }
        if (isset($_POST['parcours']) && $_POST["parcours"] != "") {
            $values['parcours'] = $_POST['parcours'];
        }
        if (isset($_POST['ville']) && $_POST["ville"] != "") {
            $values['ville'] = $_POST['ville'];
        }
        if (isset($_POST['codePostal']) && $_POST["codePostal"] != "") {
            $values['codePostal'] = $_POST['codePostal'];
        }
        Session::getInstance()->enregistrer("requeteFiltreOffre", $values);
        ControleurOffre::offres();
    }


    public static function afficherFormulaire()
    {
        self::afficherVue("vueGenerale.php", ["contenu" => "Offre/formulaireoffre.php", "title" => "Création Offre"]);
    }


    public static function afficherDetail()
    {
        if (!isset($_GET["idOffre"])) {

            self::afficherErreur("L'id de l'offre n'est pas renseigné");
        } else {
            self::afficherVue("vueGenerale.php", ["title" => "Detail offre", "contenu" => "Offre/vueDetail.php", "offreDetail" => $_GET["idOffre"]]);
        }
    }

    public static function afficherFormulaireExterne()
    {
        if (ConnexionUtilisateur::estConnecte() && ConnexionUtilisateur::estEtudiant() || ConnexionUtilisateur::estSecretariat()) {
            self::afficherVue("vueGenerale.php", ["title" => "FormulaireExterne", "contenu" => "Offre/formulaireOffreExterneStage.html"]);
        }
        else {
            self::afficherErreur("Vous n'avez pas les droits pour accéder a cette fontionnalité");
        }
    }

    public static function afficherMenuPostulerOffre()
    {
        $offresCandidate = null;
        if (ConnexionUtilisateur::estEtudiant()) {
            $stage = (new StageRepository())->recupererParEtudiant(ConnexionUtilisateur::getLoginUtilisateurConnecte());
            if($stage == null){
                $postulers = (new PostulerRepository())->recupererParEtudiant(ConnexionUtilisateur::getLoginUtilisateurConnecte());
                if ($postulers != null) {
                    foreach ($postulers as $postuler) {
                        $offresCandidate[] = (new OffreRepository())->recupererParClePrimaire($postuler->getIdOffre());
                    }
                }
            }else{
                $offresCandidate[] =  (new OffreRepository())->recupererParClePrimaire($stage->getIdOffreStage());
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Etudiant/vueMenuPostulerOffre.php", "title" => "Vos candidatures", "offresCandidate" => $offresCandidate]);
        }else {
            self::afficherErreur("Vous n'avez pas les droits pour accéder a cette fontionnalité");
        }

    }




    public static function verifierDate() {
        // continue cette fontion tu peux le faire tu sais quoi faire bg
        if (isset($_POST['dateDebutStage']) && isset($_POST['dateFinStage']) && isset($_POST['login']) && isset($_POST['stage'])) {
            $dateDebut = DateTime::createFromFormat('Y-m-d', $_POST['dateDebutStage']);
            $dateFin = DateTime::createFromFormat('Y-m-d', $_POST['dateFinStage']);
            $valeurStage = $_POST['stage'];

            $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_POST['login']);

            if ((new EtudiantRepository())->stageEnCoursTrouve($etudiant, $dateDebut, $dateFin)) {
                header('Content-Type: application/json');
                $message = 'vous possédez déjà un stage ou une alternance en cours';
                echo json_encode(['date' => false, 'date2' => false, 'messageError' => $message]);
            }
            else if ($valeurStage == "Stage") {
                if ($etudiant->getPromotion() == 2) {
                    $diff = $dateFin->diff($dateDebut);
                    if ($dateDebut->format('m') != 4) {
                        header('Content-Type: application/json');
                        $message = 'La date de début doit être au mois d\'avril';
                        echo json_encode(['date' => false, 'date2' => true, 'messageError' => $message]);
                    } else if ($dateDebut->format('d') < 8 && $dateDebut->format('m') == 4) {
                        header('Content-Type: application/json');
                        $message = 'La date de début doit être au moins le 8 avril';
                        echo json_encode(['date' => false, 'date2' => true, 'messageError' => $message]);
                    } else if ($dateFin->format('d') > 5 && $dateFin->format('m') == 7) {
                        header('Content-Type: application/json');
                        $message = 'La date de fin doit être au plus le 5 juillet';
                        echo json_encode(['date' => true, 'date2' => false, 'messageError' => $message]);
                    } else if ($dateDebut->format('Y') != (new DateTime())->format('Y') && $dateDebut->format('Y') != (new DateTime())->modify('+1 year')->format('Y')) {
                        header('Content-Type: application/json');
                        $message = 'La date de début doit être dans l\'année en cours ou l\'année suivante';
                        echo json_encode(['date' => false, 'date2' => true, 'messageError' => $message]);
                    } else if ($dateFin->format('m') != 7) {
                        header('Content-Type: application/json');
                        $message = 'La date de fin doit être au mois de juillet';
                        echo json_encode(['date' => true, 'date2' => false, 'messageError' => $message]);
                    } else if ($dateFin->format('Y') != (new DateTime())->format('Y') && $dateFin->format('Y') != (new DateTime())->modify('+1 year')->format('Y')) {
                        header('Content-Type: application/json');
                        $message = 'La date de fin doit être dans l\'année en cours ou l\'année suivante';
                        echo json_encode(['date' => true, 'date2' => false, 'messageError' => $message]);
                    } else if ($dateDebut > $dateFin) {
                        header('Content-Type: application/json');
                        $message = 'La date de début doit être avant la date de fin';
                        echo json_encode(['date' => false, 'date2' => true, 'messageError' => $message]);
                    } else if ($diff->days < 70) {
                        header('Content-Type: application/json');
                        $message = 'La durée du stage doit être de 70 jours minimum';
                        echo json_encode(['date' => false, 'date2' => false, 'messageError' => $message]);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => true]);
                    }
                } else if ($etudiant->getPromotion() == 3) {
                    $diff = $dateFin->diff($dateDebut);
                    if ($dateDebut->format('m') != 3) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => true]);
                    } else if ($dateDebut->format('d') < 25 && $dateDebut->format('m') == 3) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => true]);
                    } else if ($dateFin->format('d') > 28 && $dateFin->format('m') == 8) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => false]);
                    } else if ($dateDebut->format('Y') != (new DateTime())->modify('+1 year')->format('Y')) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => true]);
                    } else if ($dateFin->format('m') != 7) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => false]);
                    } else if ($dateFin->format('Y') != (new DateTime())->modify('+1 year')->format('Y')) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => false]);
                    } else if ($dateDebut && $dateFin && $dateDebut > $dateFin) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => true]);
                    } else if ($dateDebut < new DateTime()) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => true]);
                    } else if ($dateFin < new DateTime()) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => false]);
                    } else if ($diff->days < 70) {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => false]);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => true]);
                    }
                }
            }
            else if ($valeurStage == "Alternance") {
                // elle peut commencer de semtembre de l'année en cours jusqu'a la fin de la formation

                if ($etudiant->getPromotion() == 2) {
                    // peut quand on veut a partir du moment ou la personne est passé en deuxième année et a validé ces spé
                    $anneeDebutAlternance = (new DateTime())->format('Y');
                    $jourPossibleDebutAlternance = 20;
                    $moisPossibleDebutAlternance = 7;

                    $anneeFinAlternance = (new DateTime())->modify('+1 year')->format('Y');
                    $moisPossibleFinAlternance = 8;
                    $jourPossibleFinAlternance = 31;

                    if($dateDebut < DateTime::createFromFormat('Y-m-d', $anneeDebutAlternance.'-'.$moisPossibleDebutAlternance.'-'.$jourPossibleDebutAlternance)) {
                        $message = 'La date de début doit être au mois de juillet';
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => true, 'messageError' => $message]);
                    }
                    else if ($dateFin > DateTime::createFromFormat('Y-m-d', $anneeFinAlternance.'-'.$moisPossibleFinAlternance.'-'.$jourPossibleFinAlternance)) {
                        $message = 'La date de fin dois se terminer max en Aout de l\'année suivante';
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => false, 'messageError' => $message]);
                    }
                    else if ($dateDebut < new DateTime()) {
                        $message = 'La date de début doit être après la date du jour';
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => false, 'messageError' => $message]);
                    }
                    else if ($dateFin > new DateTime()) {
                        $message = 'La date de fin doit être après la date du jour';
                        header('Content-Type: application/json');
                        echo json_encode(['date' => false, 'date2' => false, 'messageError' => $message]);
                    }
                    else {
                        header('Content-Type: application/json');
                        echo json_encode(['date' => true, 'date2' => true]);
                    }
                }
            }
            else {
                header('Content-Type: application/json');
                echo json_encode(['date' => true, 'date2'=> true]);
            }
        }
        // a voir si je dois le laisser ou aps car je ne sais pas si je dois le laisser ou pas
        /*else {
            header('Content-Type: application/json');
            echo json_encode(['date' => false, 'date2'=> false]);
        }*/
        return 0;
    }

public static function supprimerFiltreOffre()
{
    Session::getInstance()->supprimer("requeteFiltreOffre");
    self::Offres();
}



}