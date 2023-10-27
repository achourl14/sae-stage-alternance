<?php
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\OffreRepository;

if(isset($_GET["idOffre"])){
    echo '<div class="offre_detail">';
    $offre = (new OffreRepository())->recupererParClePrimaire($_GET["idOffre"]);
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise());
    $type = "Stage et Alternance";
    if($offre->getType() == "S"){
        $type = "Stage";
    }else if($offre->getType() == "A"){
        $type = "Alternance";
    }
    echo "<h1>".htmlspecialchars($offre->getNomOffre())."</h1>";
    echo "<h2> Entreprise : " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h2>";
    echo "<h2> Adresse : ". $entreprise->getAdresse() ."</h2>";

    echo '<a class="boutonGeneral"  href="#"> Postuler sur cette offre </a>';

    echo "<hr/>";
    echo "<h1> Detail du poste : </h1>";

    echo "<h3> &#128182; Rémunération </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'> Environ ".$offre->getRemuneration() ." € par mois</p>";
    echo "</div>";

    echo "<h3> &#128188; Type de poste </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>".$type ."</p>";
    echo "</div>";

    echo "<h3> &#128198; Dates </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'> Date de début : ".$offre->getDateDebut() ."</p>";
    echo "<p class='case'> Date de fin : ".$offre->getDateFin() ."</p>";
    echo "</div>";

    echo "<h3> Mission </h3>";
    echo("<p>" . htmlspecialchars($offre->getMission()) . "</p> ");

    echo'</div>';
}


