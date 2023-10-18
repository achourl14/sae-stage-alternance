<?php

use App\Modele\Repository\EntrepriseRepository;

$nbStage =0;
$nbAlternance = 0;
$class = null;
$buttonValider = "";
echo '<div class="offres">';
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gérer les offres </div>";
if ($offresStage != null) {
    foreach ($offresStage as $offre) {
        if ($offre->getValidation()) {
            $class = "valide";
            $buttonValider = "Invalidez Stage";
            $classButton = "valideButton";
        } else {
            $class = "nonValide";
            $buttonValider = "Validez Stage";
            $classButton = "";
        }
        echo "<a href='controleurFrontal.php?action=consulterOffreSecretaire&idStage=".$offre->getIdStage()."'>";
        echo '<div class ="carte ' . $class . '">';
        echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
        echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
        echo("<p>" . htmlspecialchars(substr($offre->getMission(),0,50))  . "</p> ");

        echo("<p> " . htmlspecialchars($offre->getStatutStage()) . " </p>");
        echo("<h3 class='type'> Stage </h3>");
        echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?action=validerOffreStage&id=" . $offre->getIdStage() . "'>" . $buttonValider . "</a>");
        echo "</div>";
        echo "</a>";
    }

}

if ($offresAlternance != null) {
    foreach ($offresAlternance as $offre) {
        if ($offre->getValidation()) {
            $class = "valide";
            $buttonValider = "Invalidez Alternance";
            $classButton = "valideButton";
        } else {
            $class = "nonValide";
            $buttonValider = "Validez Alternance";
            $classButton = "";
        }
        echo "<a href='controleurFrontal.php?action=consulterOffreSecretaire&idAlternance=".$offre->getIdAlternance()."'>";
        echo '<div class="carte ' . $class . '">';
        echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
        echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
        echo("<p>" . htmlspecialchars(substr($offre->getMission(),0,50)) . "</p> ");

        echo("<p> " . htmlspecialchars($offre->getStatutAlternance()) . " </p>");
        echo("<h3 class='type'> Alternance </h3>");
        echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?action=validerOffreAlternance&id=" . $offre->getIdAlternance() . "'>" . $buttonValider . "</a>");
        echo "</div>";
        echo "</a>";
    }
}
echo'</div>';
require __DIR__ . "/{$contenuDetail}";
echo'</div>';