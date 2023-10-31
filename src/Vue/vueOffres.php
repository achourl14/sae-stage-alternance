<?php

use App\Modele\DataObject\Offre;
use App\Modele\Repository\EntrepriseRepository;


echo '<div class="toutesLesCartes">';
echo "<div class='title'> Offres disponible </div>";

echo '<div class="filtres">
            <div>
                <label class="details" for="stage">Stage </label>
                <input type="radio" placeholder="" name="offre" id="stage" value="stage" required/>
            </div>
            <div>
                 <label class="details" for="alternance">Alternance </label>
                 <input type="radio" placeholder="" name="offre" id="alternance" value="alternance" required/>
            </div>
        </div>';

echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?action=consulterOffre&page=". $pageActuelle-1 ."'> page précédente </a> </div>";
if($pageActuelle != 1){
    echo "<div> <a class='' href='controleurFrontal.php?action=consulterOffre&page=". $pageActuelle-1 ."'>". $pageActuelle-1 ."</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?action=consulterOffre&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?action=consulterOffre&page=". $pageActuelle+1 ."'> page suivante </a> </div>";
echo "</div>";


echo '<div class = "groupCartes">';
    foreach ($offreses as $offre) {

        $type = "Stage et Alternance";
        if($offre->getType() == "S"){
            $type = "Stage";
        }else if($offre->getType() == "A"){
            $type = "Alternance";
        }
            echo "<a href='controleurFrontal.php?action=afficherDetail&idOffre=" . $offre->getIdOffre() . "'>";
            echo '<div class ="carte">';
            echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
            echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
            echo("<p>" . htmlspecialchars(substr($offre->getMission(), 0, 40)) . "</p> ");

            echo("<p> " . htmlspecialchars($offre->getStatut()) . " </p>");
            echo("<h3 class='type'>". $type  ."</h3>");
            echo "</div>";
            echo "</a>";
    }
}
echo '</div>';
    require __DIR__ . "/{$contenuDetail}";
echo '</div>';
echo'</div>';
?>