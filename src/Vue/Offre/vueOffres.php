<?php

use App\Modele\DataObject\Offre;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\HTTP\Session;
use App\Modele\Repository\OffreRepository;

$class = null;
$buttonValider = "";
$stage = "";
$alternance = "";
$sa = "";

$validation = "";
$aValider = "";

$nosOffres = "";
if(Session::getInstance()->contient("requeteFiltreOffre")){
    $values = Session::getInstance()->lire("requeteFiltreOffre");

    if(isset($values["type"])){
        $array = $values["type"];
        if(in_array("S",$array)){
            $stage = "checked";
        }
        if(in_array("A",$array)){
            $alternance = "checked";
        }
        if(in_array("SA",$array)){
            $sa = "checked";
        }
    }else{
        $stage = "checked";
        $alternance = "checked";
        $sa = "checked";
    }

    if(isset($values["validation"])){
        if($values["validation"] == 0){
            $aValider = "checked";
        }else{
            $validation = "checked";
        }
    }else{
        $validation = "checked";
        $aValider = "checked";
    }

    if(isset($values["idEntreprise"])){
        $nosOffres = "checked";
    }
}else{
    $stage = "checked";
    $alternance = "checked";
    $sa = "checked";
    $validation = "checked";
    $aValider = "checked";
}

if(!isset($values["idEntreprise"])){
    $values["idEntreprise"] = "";
}
if(!isset($values["nomOffre"])){
    $values["nomOffre"] = "";
}
if(!isset($values["remuneration"])){
    $values["remuneration"] = "";
}
if(!isset($values["but_annee"])){
    $values["but_annee"] = "";
}
if(!isset($values["parcours"])){
    $values["parcours"] = "";
}
if(!isset($values["ville"])){
    $values["ville"] = "";
}
if(!isset($values["codePostal"])){
    $values["codePostal"] = "";
}

echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gérer les offres </div>";
?>

    <div class="contient">
    <div class="content">
<form method="post" action="controleurFrontal.php?controleur=offre&action=filtrer">
        <div class="user-details">

            <?php
if(!\App\Lib\ConnexionUtilisateur::estEntreprise()) {
    echo '<article>
            <span>Stage</span>
            <input type="checkbox" name="Stage" value="stage" ' . $stage . ' />
          </article>
      
          <article>
            <span> Alternance </span>
            <input type="checkbox" name="Alternance" value="alternance" ' . $alternance . '/>                        
          </article>         
          
          <article>
            <span> Stage et Alternance</span>
            <input type="checkbox" name="StageAlternance" value="stageAlternance" ' . $sa . '/>                        
          </article>   
       ';

    if (\App\Lib\ConnexionUtilisateur::estMaitreSA()) {
        echo '<article>
            <span> Valider </span>
            <input type="checkbox" name="Valider" value="valider" ' . $validation . '/>
          </article>
      
         <article>
            <span> A Valider </span>
            <input type="checkbox" name="Avalider" value="avalider" ' . $aValider . '/> 
        </article>';

    }
}?>
            <div class="input-box-search">
                <span class="details">Numéro siret de l'entreprise</span>
                <?php echo '<input type="text" name="idEntreprise" pattern="[0-9]{14}" minlength="14" maxlength="14" value="'.$values["idEntreprise"].'"/>'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Nom de l'offre</span>
                <?php echo '<input type="text" placeholder="" name="nomOffre" maxlength="50" value="'.$values["nomOffre"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Rémunération </span>
                <?php echo '<input type="text" placeholder="" name="remuneration" maxlength="50" value="'.$values["remuneration"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Année des élèves rechercher</span>
                <?php echo '<input type="text" placeholder="" name="but_annee" maxlength="50" value="'.$values["but_annee"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Parcours </span>
                <?php echo '<input type="email" placeholder="" name="parcours" maxlength="100" value="'.$values["parcours"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Ville de l'offre</span>
                <?php echo '<input type="tel" placeholder="" name="ville" pattern="[0-9]{10}" maxlength="10" value="'.$values["ville"].'">' ?>
            </div>
            <div class="input-box-search">
                <span class="details">Code postal de l'offre</span>
                <?php echo '<input type="tel" placeholder="" name="codePostal" pattern="[0-9]{10}" maxlength="10" value="'.$values["codePostal"].'">' ?>
            </div>

<?php
    echo '
</div>
<div class="button">
            <input type="submit" value="Rechercher">
            <a href="controleurFrontal.php?action=supprimerFiltreEntreprise"> Rénitialiser </a>
        </div>
        </form>
</div>
    </div>';



echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?controleur=offre&action=offres&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=offre&action=offres&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=offre&action=offres&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?controleur=offre&action=offres&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";




echo '<div class="groupCartes">';
foreach ($offreses as $offre) {
    $type = "Stage et Alternance";
    if ($offre->getType() == "S") {
        $type = "Stage";
    } else if ($offre->getType() == "A") {
        $type = "Alternance";
    }

    if(\App\Lib\ConnexionUtilisateur::estMaitreSA()){
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

    echo "<a href='controleurFrontal.php?controleur=offre&action=afficherDetail&idOffre=" . $offre->getIdOffre() . "'>";
    echo '<div class ="carte ' . $class . '">';
    echo("<h1>" . htmlspecialchars($offre->getNomOffre()) . "</h1>");
    echo "<h2> Entreprise : " . htmlspecialchars((new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise())->getNomEntreprise()) . "</h2>";
    echo("<p>" . htmlspecialchars(substr($offre->getMission(), 0, 45)) . "</p> ");

    echo("<p> " . htmlspecialchars($offre->getStatut()) . " </p>");
    echo("<h3 class='type'>" . $type . "</h3>");
    if(\App\Lib\ConnexionUtilisateur::estMaitreSA()){
        echo("<a class='buttonDeBase " . $classButton . "' href='controleurFrontal.php?controleur=offre&action=validerOffre&id=" . $offre->getIdOffre() . "'>" . $buttonValider . "</a>");
    }
    echo "</div>";
    echo "</a>";
}

echo '</div>';
echo '</div>';