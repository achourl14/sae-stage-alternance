<?php

namespace App\Controleur;

use App\Modele\DataObject\Alternance;
use App\Modele\DataObject\Stage;
use App\Modele\Repository\AlternanceRepository;
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

}