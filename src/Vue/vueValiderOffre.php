<?php

use App\Modele\DataObject\Offre;
use App\Modele\Repository\EntrepriseRepository;

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
        $type = "Stage et Alternance";
        if($offre->getType() == "S"){
            $type = "Stage";
        }else if($offre->getType() == "A"){
            $type = "Alternance";
        }

            if ($offre->getValidation()) {
                $class = "valide";
                $buttonValider = "Invalidez Stage";
                $classButton = "valideButton";
            } else {
                $class = "nonValide";
                $buttonValider = "Validez Stage";
                $classButton = "nonValideButton";
            }
            echo "<a href='controleurFrontal.php?action=afficherDetail&idOffre=" . $offre->getIdOffre() . "'>";
            echo '<div class ="carte ' . $class . '">';
            echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
            echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
            echo("<p>" . htmlspecialchars(substr($offre->getMission(), 0, 50)) . "</p> ");

            echo("<p> " . htmlspecialchars($offre->getStatut()) . " </p>");
            echo("<h3 class='type'>". $type  ."</h3>");
            echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?action=validerOffre&id=" . $offre->getIdOffre() . "'>" . $buttonValider . "</a>");
            echo "</div>";
            echo "</a>";
    }

echo'</div>';
echo'</div>';