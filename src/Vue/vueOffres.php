<?php

use App\Modele\Repository\EntrepriseRepository;

$nbStage = 0;
$nbAlternance = 0;
echo '<div class="offres">';

echo '<div class="filtres">';
echo '</div>';
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Offres disponible </div>";
if ($offresStage != null) {
    foreach ($offresStage as $offre) {
        echo "<a href='controleurFrontal.php?action=consulterOffre&idStage=".$offre->getIdStage()."'>";
        echo '<div class ="carte">';
        echo("<h1>" .  htmlspecialchars($offre->getNomOffre()) . "</h1>");
        echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
        echo("<p>" . htmlspecialchars(substr($offre->getMission(),0,50)) . "</p> ");

        echo("<p> " . htmlspecialchars($offre->getStatutStage()) . " </p>");
        echo("<h3 class='type'> Stage </h3>");
        echo "</div>";
        echo "</a>";
    }
}

if ($offresAlternance != null) {
    foreach ($offresAlternance as $offre) {
        echo "<a href='controleurFrontal.php?action=consulterOffre&idAlternance=".$offre->getIdAlternance()."'>";
        echo '<div class ="carte">';
        echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
        echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
        echo("<p>" . htmlspecialchars(substr($offre->getMission(),0,50)) . "</p> ");

        echo("<p> " . htmlspecialchars($offre->getStatutAlternance()) . " </p>");
        echo("<h3 class='type'> Alternance </h3>");
        echo "</div>";
        echo "</a>";
    }
}
echo '</div>';
    require __DIR__ . "/{$contenuDetail}";
echo '</div>';
?>