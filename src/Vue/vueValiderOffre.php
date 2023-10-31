<?php

use App\Modele\DataObject\OffredeStage;
use App\Modele\Repository\EntrepriseRepository;

$nbStage = 0;
$nbAlternance = 0;
$class = null;
$buttonValider = "";
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gérer les offres </div>";


/*echo '<div class="filtres">
            <div>
                <label class="details" for="stage">Stage </label>
                <input type="radio" placeholder="" name="offre" id="stage" value="stage" required/>
            </div>
            <div>
                 <label class="details" for="alternance">Alternance </label>
                 <input type="radio" placeholder="" name="offre" id="alternance" value="alternance" required/>
            </div>
            <div>
                <label class="details" for="valider">Valider </label>
                <input type="radio" placeholder="" name="offre" id="stage" value="valider" required/>
            </div>
            <div>
                 <label class="details" for="non_valider">Pas encore valider </label>
                 <input type="radio" placeholder="" name="offre" id="alternance" value="invalider" required/>
            </div>
        </div>';*/

echo '<form method="post" action="controleurFrontal.php?action=filtrer">
          <article class="feature1">
            <input type="checkbox" name="Stage" id="feature1" value="stage"/>
            <div>
              <span>
                    Stage
                </span>
            </div>
          </article>
      
          <article class="feature2">
            <input type="checkbox" name="Alternance" id="feature2" value="alternance"/>
                 <div>
                    <span> Alternance </span>
                 </div>
          </article>
      
          <article class="feature3">
            <input type="checkbox" name="Valider" id="feature3" value="valider"/>
                <div>
                    <span> Valider </span>
                </div>
         </article>
      
         <article class="feature4">
            <input type="checkbox" name="Avalider" id="feature4" value="avalider"/>
                <div>
                 <span> A Valider </span>
                 </div>
        </article>
         <article>
            <input type="submit" value="Envoyer" />
             <div >
                <span> Envoyer </span>
            </div>
        </article>
</form>';



echo "<div class='page'>";
if ($pageActuelle == 1) {
    $hiddePrec = 'hidden';
} else {
    $hiddePrec = '';
}
echo "<div> <a class='$hiddePrec' href='controleurFrontal.php?action=consulterOffreSecretaire&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?action=consulterOffreSecretaire&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
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
    } else {
        if ($offre->getValidation()) {
            $class = "valide";
            $buttonValider = "Invalidez Alternance";
            $classButton = "valideButton";
        } else {
            $class = "nonValide";
            $buttonValider = "Validez Alternance";
            $classButton = "nonValideButton";
        }
        echo "<a href='controleurFrontal.php?action=afficherDetail&idAlternance=" . $offre->getIdAlternance() . "'>";
        echo '<div class="carte ' . $class . '">';
        echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
        echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
        echo("<p>" . htmlspecialchars(substr($offre->getMission(), 0, 50)) . "</p> ");

        echo("<p> " . htmlspecialchars($offre->getStatutAlternance()) . " </p>");
        echo("<h3 class='type'> Alternance </h3>");
        echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?action=validerOffreAlternance&id=" . $offre->getIdAlternance() . "'>" . $buttonValider . "</a>");
        echo "</div>";
        echo "</a>";
    }
}

echo '</div>';
echo '</div>';