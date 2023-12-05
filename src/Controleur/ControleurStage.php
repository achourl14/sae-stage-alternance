<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Stage;
use App\Modele\Repository\AlternanceRepository;
use App\Modele\Repository\EtudiantRepository;
use App\Modele\Repository\PostulerRepository;
use App\Modele\Repository\StageRepository;

class ControleurStage extends ControleurGenerique
{


    public static function creerStageExterne(): void
    {
        $stage = $_POST['stage'];

        ControleurEntreprise::entrepriseStageExterne();

        if ($stage == "Stage") {
            $stageEtudiant = new Stage($_POST["idEtudiantStage"], 0, $_POST["numMaitreStage"], $_POST["idTuteurStage"], $_POST["dateDebutStage"], $_POST["dateFinStage"], $_POST["remuneration"], $_POST["num_siret"]);
            StageRepository::sauvegarder($stageEtudiant);
        } else {
            $alternanceExterneEtudiant = new Alternance($_POST["idEtudiantStage"], 0, $_POST["numMaitreStage"], $_POST["idTuteurStage"], $_POST["dateDebutStage"], $_POST["dateFinStage"], $_POST["remuneration"], $_POST["num_siret"]);
            AlternanceRepository::sauvegarder($alternanceExterneEtudiant);
        }
    }

    public static function choixDefinitif(){
        if(ConnexionUtilisateur::estEtudiant()){
            if(isset($_GET["idOffre"])){
                $postuler = (new PostulerRepository())->recupererParClePrimaire(ConnexionUtilisateur::getLoginUtilisateurConnecte(),$_GET['idOffre']);
                if($postuler != null && $postuler->getEtat() == 1){
                    $stage = new Stage(ConnexionUtilisateur::getLoginUtilisateurConnecte(),$_GET["idOffre"]);
                    StageRepository::sauvegarder($stage);
                    (new PostulerRepository())->deleteAllPostulerFromEtudiant(ConnexionUtilisateur::getLoginUtilisateurConnecte());
                }else{
                    echo '<div class="msgConfirmation"><p> Vous n\'avez jamais été accepté à cette offre </p></div>';
                    self::afficherAccueil();
                }
            }
        }else{
            echo '<div class="msgConfirmation"><p> Vous n\'avez pas les droits </p></div>';
            self::afficherAccueil();
        }
    }

}