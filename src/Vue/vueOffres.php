<?php

use App\Modele\DataObject\Offre;
use App\Modele\Repository\EntrepriseRepository;

$class = null;
$buttonValider = "";
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gérer les offres </div>";

echo '<form method="post" action="controleurFrontal.php?action=filtrer">
          <article>
            <span>Stage</span>
            <input type="checkbox" name="Stage" value="stage"/>
          </article>
      
          <article>
            <span> Alternance </span>
            <input type="checkbox" name="Alternance" value="alternance"/>                        
          </article>          
       ';

if(\App\Lib\ConnexionUtilisateur::estSecretariat()){
    echo '<article>
            <span> Valider </span>
            <input type="checkbox" name="Valider" value="valider"/>
          </article>
      
         <article>
            <span> A Valider </span>
            <input type="checkbox" name="Avalider" value="avalider"/> 
        </article>';

}

if(\App\Lib\ConnexionUtilisateur::estEntreprise()){
    echo '<article>
            <span> NosOffres </span>
            <input type="checkbox" name="nosOffres"  value="nosOffres"/>
         </article>';
}

echo '<article>
            <input type="submit" value="Envoyer" />
        </article>';
echo '</form>';



echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?action=offres&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?action=offres&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?action=offres&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?action=offres&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";


echo '<div class="groupCartes">';
foreach ($offreses as $offre) {
    $type = "Stage et Alternance";
    if ($offre->getType() == "S") {
        $type = "Stage";
    } else if ($offre->getType() == "A") {
        $type = "Alternance";
    }

    if(\App\Lib\ConnexionUtilisateur::estSecretariat()){
        if ($offre->getValidation()) {
            $class = "valide";
            $buttonValider = "Invalidez Offre";
            $classButton = "valideButton";
        } else {
            $class = "nonValide";
            $buttonValider = "Validez Offre";
            $classButton = "nonValideButton";
        }
    }

    echo "<a href='controleurFrontal.php?action=afficherDetail&idOffre=" . $offre->getIdOffre() . "'>";
    echo '<div class ="carte ' . $class . '">';
    echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
    echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
    echo("<p>" . htmlspecialchars(substr($offre->getMission(), 0, 45)) . "</p> ");

    echo("<p> " . htmlspecialchars($offre->getStatut()) . " </p>");
    echo("<h3 class='type'>" . $type . "</h3>");
    if(\App\Lib\ConnexionUtilisateur::estSecretariat()){
        echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?action=validerOffre&id=" . $offre->getIdOffre() . "'>" . $buttonValider . "</a>");
    }
    echo "</div>";
    echo "</a>";
}

echo '</div>';
echo '</div>';