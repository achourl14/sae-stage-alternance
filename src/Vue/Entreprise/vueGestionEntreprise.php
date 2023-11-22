<?php

use App\Modele\HTTP\Session;

echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gestion des Entreprise </div>";

echo '<div class="contient">';
echo '<div class="content">';

$recherche = null;
if(Session::getInstance()->contient("requeteFiltreEntreprise")){
    $recherche = Session::getInstance()->lire("requeteFiltreEntreprise");
}
foreach((new \App\Modele\Repository\EntrepriseRepository())->getNomsColones() as $nomCol){
    if(!isset($recherche[$nomCol])){
        $recherche[$nomCol] = "";
    }
    if(!isset($recherche[(new \App\Modele\Repository\EntrepriseRepository())->getNomClePrimaire()])){
        $recherche[(new \App\Modele\Repository\EntrepriseRepository())->getNomClePrimaire()] = "";
    }
}
?>

    <form method="post" action="controleurFrontal.php?controleur=entreprise&action=rechercherEntreprise">
        <div class="user-details">
            <div class="input-box-search">
                <span class="details">Numéro siret</span>
                <?php echo '<input type="text" name="num_siret" pattern="[0-9]{14}" minlength="14" maxlength="14" value="'.$recherche["numSiret"].'"/>'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Nom de l'entreprise</span>
                <?php echo '<input type="text" placeholder="" name="nom_entreprise" maxlength="50" value="'.$recherche["nomEntreprise"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Adresse</span>
                <?php echo '<input type="text" placeholder="" name="adresse" maxlength="50" value="'.$recherche["adresseEntreprise"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">interlocuteur</span>
                <?php echo '<input type="text" placeholder="" name="interlocuteur" maxlength="50" value="'.$recherche["interlocuteurPrincipal"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Adresse mail</span>
                <?php echo '<input type="email" placeholder="" name="mail" maxlength="100" value="'.$recherche["adressemail"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Téléphone</span>
                <?php echo '<input type="tel" placeholder="" name="telephone" pattern="[0-9]{10}" maxlength="10" value="'.$recherche["telephoneEntreprise"].'">' ?>
            </div>
            <div class="input-box-search">
                <span class="details">code APE</span>
                <?php echo '<input type="text" placeholder="" name="code_ape" pattern="[0-3]{1}" maxlength="1" value="'.$recherche["codeAPE"].'">' ?>
            </div>
            <div class="input-box-search">
                <span class="details">Secteur d'activité</span>
                <?php echo '<input type="text" placeholder="" name="secteur_activite" maxlength="50" value="'.$recherche["secteurActivite"].'">'; ?>
            </div>
        </div>
        <div class="button">
            <input type="submit" value="Rechercher">
            <a href="controleurFrontal.php?action=supprimerFiltreEntreprise"> Rénitialiser </a>
        </div>
    </form>
    </div>
    </div>
<?php
echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";
echo '<div class = "groupCartes">';
foreach ($entreprises as $entreprise) {

    echo "<a href='controleurFrontal.php?controleur=entreprise&action=afficherDetailEntreprise&numSiret=" . $entreprise->getNumSiret() . "'>";
    echo '<div class ="carte">';
    echo("<h1> Nom Entreprise: " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h1>");
    echo "<h2> Numéro Siret: " . htmlspecialchars($entreprise->getNumSiret()) . " </h2>";
    echo("<p> Adresse mail : " . htmlspecialchars($entreprise->getMail()) . " </p>");
    echo("<p> Telephone : " . htmlspecialchars($entreprise->getTelephone()) . " </p>");
    echo "</div>";
    echo "</a>";
}
echo '</div>';
echo '</div>';
