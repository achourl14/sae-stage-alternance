<?php
use App\Modele\Repository\OffredeStageRepository;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\OffreAlternanceRepository;
if(isset($_GET["idStage"])){
    echo '<div class="offre_detail">';
    $stage = (new OffredeStageRepository())->recupererParClePrimaire($_GET["idStage"]);
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($stage->getIdEntreprise());
    echo "<h1>".htmlspecialchars($stage->getNomOffre())."</h1>";
    echo "<h2> Entreprise : " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h2>";
    echo "<h2> Adresse : ". $entreprise->getAdresse() ."</h2>";
    echo("<p>" . htmlspecialchars($stage->getMission()) . "</p> ");

    echo("<p> " . htmlspecialchars($stage->getStatutStage()) . " </p>");
    echo'</div>';
}

if(isset($_GET["idAlternance"])){
    echo '<div class="offre_detail">';
    $stage = (new OffreAlternanceRepository())->recupererParClePrimaire($_GET["idAlternance"]);
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($stage->getIdEntreprise());
    echo "<h1>".htmlspecialchars($stage->getNomOffre())."</h1>";
    echo "<h2> Entreprise : " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h2>";
    echo "<h2> Adresse : ". $entreprise->getAdresse() ."</h2>";
    echo("<p>" . htmlspecialchars($stage->getMission()) . "</p> ");

    echo("<p> " . htmlspecialchars($stage->getStatutAlternance()) . " </p>");
    echo'</div>';
}


