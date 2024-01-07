<?php
use App\Modele\HTTP\Session;
use App\Modele\Repository\ConventionAlternanceRepository;

echo '<div class="toutesLesCartes">';
echo "<div class='title'> Conventions Alternance Finales </div>";

echo '<div class="contient">';
echo '<div class="content">';
$recherche = null;
    if(Session::getInstance()->contient("requeteFiltreConventionAlternanceFinale")){
        $recherche = Session::getInstance()->lire("requeteFiltreConventionAlternanceFinale");
    }
foreach((new ConventionAlternanceRepository())->getNomsColones() as $nomCol){
    if(!isset($recherche[$nomCol])){
        $recherche[$nomCol] = "";
    }
    if(!isset($recherche[(new ConventionAlternanceRepository())->getNomClePrimaire()])){
        $recherche[(new ConventionAlternanceRepository())->getNomClePrimaire()] = "";
    }
}

?>
    <form method="post" action="controleurFrontal.php?controleur=convention&action=rechercherConventionAlternanceFinale">
        <div class="user-details">
            <div class="input-box-search">
                <span class="details">id Convention</span>
               <?php echo '<input type="text" name="id" maxlength="11" value="'.$recherche["id"].'" />'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Nom Etudiant</span>
              <?php echo '<input type="text" placeholder="" name="nomAlternantEtu" maxlength="100" value="'.$recherche["nomAlternantEtu"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Prénom Etudiant</span>
              <?php echo '<input type="text" placeholder="" name="prenomAlternantEtu" maxlength="100" value="'.$recherche["prenomAlternantEtu"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Numero SIRET</span>
                <?php echo '<input type="text" name="siret" patern="[0-9]{14}" maxlength="14" value="'.$recherche["siret"].'" />'; ?>
            </div>
        </div>
        <div class="button">
            <input type="submit" value="Rechercher">
            <a href="controleurFrontal.php?controleur=convention&action=supprimerFiltreConventionAlternanceFinale"> Rénitialiser </a>
        </div>
    </form>
    </div>
    </div>
<?php
echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionAlternanceFinale&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionAlternanceFinale&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionAlternanceFinale&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherGestionConventionAlternanceFinale&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";

echo '<div class="page">';
echo "<div> <a class='' href='controleurFrontal.php?controleur=convention&action=afficherVueImportationConventionAlternanceFinale'> Importer des conventions </a> </div>";
echo '</div>';

echo '<div class = "groupCartes">';
if ($conventions == null) {
    echo '<div class="msgConfirmation"><p> Aucune convention d\'alternance Finale trouvé </p></div>';
} else {
    foreach ($conventions as $convention) {

        echo "<a href='controleurFrontal.php?controleur=convention&action=afficherDetailConventionAlternanceFinale&id=" . $convention->getId() . "'>";
        echo '<div class ="carte">';
        echo("<h1> Numéro : " . htmlspecialchars($convention->getId()) . "</h1>");
        echo("<p> Prénom : " . htmlspecialchars($convention->getPrenomAlternantEtu()) . " </p>");
        echo("<p> Nom : " . htmlspecialchars($convention->getNomAlternantEtu()) . " </p>");
        echo("<p> Etablissement : " . htmlspecialchars($convention->getEtablissement()) . " </p>");

        echo "</div>";
        echo "</a>";
    }
}
echo '</div>';
echo '</div>';
