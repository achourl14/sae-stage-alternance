<?php

use App\Modele\Repository\EntrepriseRepository;

$nbStage =0;
$nbAlternance = 0;
echo '<div class="offres">';
 echo '<div class="toutesLesCartesS">';
 echo "<p> Stages : </p>";
foreach($offresStage as $offre){
    echo '<div class ="carte">';
    echo ("<h1>". $offre->getNomOffre() . "</h1>");
    echo "<h2> Entreprise : ". EntrepriseRepository::getEntrepriseParSiret($offre->getIdEntreprise())->getNomEntreprise() . "</h2>";
    echo ("<p>". $offre->getMission() ."</p> ");

    echo ("<p> ".$offre->getStatutStage()." </p>");
    echo "</div>";
}
echo'</div>';

echo '<div class="toutesLesCartesA">';
echo "<p> Alternance : </p>";
foreach($offresAlternance as $offre) {
    echo '<div class ="carte">';
    echo("<h1>" . $offre->getNomOffre() . "</h1>");
    echo "<h2> Entreprise : " . EntrepriseRepository::getEntrepriseParSiret($offre->getIdEntreprise())->getNomEntreprise() . "</h2>";
    echo("<p>" . $offre->getMission() . "</p> ");

    echo("<p> " . $offre->getStatutAlternance() . " </p>");
    echo "</div>";
}
echo'</div>';
echo '</div>';
?>