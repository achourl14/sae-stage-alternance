<?php
use App\Modele\HTTP\Session;
use App\Modele\Repository\ConventionStageRepository;
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Conventions Finales </div>";

echo '<div class="contient">';
echo '<div class="content">';
$recherche = null;
    if(Session::getInstance()->contient("requeteFiltreConventionFinale")){
        $recherche = Session::getInstance()->lire("requeteFiltreConventionFinale");
    }
foreach((new ConventionStageRepository())->getNomsColones() as $nomCol){
    if(!isset($recherche[$nomCol])){
        $recherche[$nomCol] = "";
    }
    if(!isset($recherche[(new ConventionStageRepository())->getNomClePrimaire()])){
        $recherche[(new ConventionStageRepository())->getNomClePrimaire()] = "";
    }
}

?>
    <form method="post" action="controleurFrontal.php?controleur=convention&action=rechercherConventionFinale">
        <div class="user-details">
            <div class="input-box-search">
                <span class="details">Numero Convention</span>
               <?php echo '<input type="text" name="numConvention" maxlength="11" value="'.$recherche["numConvention"].'" />'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Numero Etudiant</span>
                <?php echo '<input type="text" name="numEtudiant" maxlength="11" patern="[0-9]{11}" value="'.$recherche["numEtudiant"].'" />'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Nom Etudiant</span>
              <?php echo '<input type="text" placeholder="" name="nomEtu" maxlength="100" value="'.$recherche["nomEtu"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Prénom Etudiant</span>
              <?php echo '<input type="text" placeholder="" name="prenomEtu" maxlength="100" value="'.$recherche["prenomEtu"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Numero SIRET</span>
                <?php echo '<input type="text" name="siret" patern="[0-9]{14}" maxlength="14" value="'.$recherche["siret"].'" />'; ?>
            </div>
        </div>
        <div class="button">
            <input type="submit" value="Rechercher">
            <a href="controleurFrontal.php?controleur=convention&action=supprimerFiltreConventionFinale"> Rénitialiser </a>
        </div>
    </form>
    </div>
    </div>
<?php
echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionFinale&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionFinale&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionFinale&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionFinale&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";

echo '<div class="page">';
echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherVueImportationConventionFinale'> Importer des conventions </a> </div>";
echo '</div>';

echo '<div class = "groupCartes">';
if ($conventions == null) {
    echo '<div class="msgConfirmation"><p> Aucune convention Finale trouvé </p></div>';
} else {
    foreach ($conventions as $convention) {

        echo "<a href='controleurFrontal.php?controleur=convention&action=afficherDetailConventionFinale&numConvention=" . $convention->getNumConvention() . "'>";
        echo '<div class ="carte">';
        echo("<h1> Numéro : " . htmlspecialchars($convention->getNumConvention()) . "</h1>");
        echo("<p> Prénom : " . htmlspecialchars($convention->getPrenomEtu()) . " </p>");
        echo("<p> Nom : " . htmlspecialchars($convention->getNomEtu()) . " </p>");
        echo("<p> Numéro Etudiant : " . htmlspecialchars($convention->getNumEtudiant()) . " </p>");

        echo "</div>";
        echo "</a>";
    }
}
echo '</div>';
echo '</div>';
