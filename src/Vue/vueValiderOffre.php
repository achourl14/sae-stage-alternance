<?php

use App\Modele\DataObject\OffredeStage;
use App\Modele\Repository\EntrepriseRepository;

$nbStage =0;
$nbAlternance = 0;
$class = null;
$buttonValider = "";
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gérer les offres </div>";
echo "<div class='page'>";
if($pageActuelle==1){
    $hiddePrec = 'hidden';
}else{
    $hiddePrec = '';
}
echo "<div> <a class='$hiddePrec' href='controleurFrontal.php?action=consulterOffreSecretaire&page=". $pageActuelle-1 ."'> page précédente </a> </div>";
echo "<div> <p> $pageActuelle </p> </div>";
if($pageActuelle != $nbrePages){
    echo "<div> <a class='' href='controleurFrontal.php?action=consulterOffreSecretaire&page=". $pageActuelle+1 ."'> page suivante </a> </div>";
}
echo "</div>";
echo '<div class="groupCartes">';
    foreach ($offreses as $offre) {
        if (get_class($offre) == OffredeStage::class) {
            if ($offre->getValidation()) {
                $class = "valide";
                $buttonValider = "Invalidez Stage";
                $classButton = "valideButton";
            } else {
                $class = "nonValide";
                $buttonValider = "Validez Stage";
                $classButton = "nonValideButton";
            }
            echo "<a href='controleurFrontal.php?action=afficherDetail&idStage=" . $offre->getIdStage() . "'>";
            echo '<div class ="carte ' . $class . '">';
            echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
            echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
            echo("<p>" . htmlspecialchars(substr($offre->getMission(), 0, 50)) . "</p> ");

            echo("<p> " . htmlspecialchars($offre->getStatutStage()) . " </p>");
            echo("<h3 class='type'> Stage </h3>");
            echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?action=validerOffreStage&id=" . $offre->getIdStage() . "'>" . $buttonValider . "</a>");
            echo "</div>";
            echo "</a>";
        }else{
            if ($offre->getValidation()) {
                $class = "valide";
                $buttonValider = "Invalidez Alternance";
                $classButton = "valideButton";
            } else {
                $class = "nonValide";
                $buttonValider = "Validez Alternance";
                $classButton = "nonValideButton";
            }
            echo "<a href='controleurFrontal.php?action=afficherDetail&idAlternance=".$offre->getIdAlternance()."'>";
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
echo'</div>';