<?php

echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gestion des Entreprise </div>";

    echo '<div class="contient">';
    echo '<div class="content">';
?>

<form method="post" action="controleurFrontal.php?action=rechercherEntrepise">
            <div class="user-details">
                <div class="input-box-search">
                    <span class="details">Numéro siret</span>
                    <input type="text" name="num_siret" pattern="[0-9]{14}" minlength="14" maxlength="14"/>
                </div>
                <div class="input-box-search">
                    <span class="details">Nom de l'entreprise</span>
                    <input type="text" placeholder="" name="nom_entreprises" pattern="[0-9]{10}" maxlength="10">
                </div>
                <div class="input-box-search">
                    <span class="details">Adresse</span>
                    <input type="text" placeholder="" name="adresse" maxlength="50">
                </div>
                <div class="input-box-search">
                    <span class="details">interlocuteur</span>
                    <input type="text" placeholder="" name="interlocuteur" maxlength="50">
                </div>
                <div class="input-box-search">
                    <span class="details">Adresse mail</span>
                    <input type="email" placeholder="" name="mail"  maxlength="100">
                </div>
                <div class="input-box-search">
                    <span class="details">Téléphone</span>
                    <input type="tel" placeholder="" name="telephone" pattern="[0-9]{10}" maxlength="10">
                </div>
                <div class="input-box-search">
                    <span class="details">code APE</span>
                    <input type="text" placeholder="" name="code APE" pattern="[0-3]{1}" maxlength="1">
                </div>
                <div class="input-box-search">
                    <span class="details">Secteur d'activité</span>
                    <input type="date" placeholder="" name="secteur_activite">
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Rechercher">
            </div>
        </form>
</div>
</div>
<?php
echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEntreprise&page=". $pageActuelle-1 ."'> page précédente </a> </div>";
if($pageActuelle != 1){
    echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEntreprise&page=". $pageActuelle-1 ."'>". $pageActuelle-1 ."</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEntreprise&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEntreprise&page=". $pageActuelle+1 ."'> page suivante </a> </div>";
echo "</div>";
echo '<div class = "groupCartes">';
foreach ($entreprises as $entreprise) {

    echo "<a href='controleurFrontal.php?action=afficherDetailEntreprise&numSiret=" . $entreprise->getNumSiret() . "'>";
    echo '<div class ="carte">';
    echo("<h1> Nom Entreprise: " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h1>");
    echo "<h2> Numéro Siret: ". htmlspecialchars($entreprise->getNumSiret()) . " </h2>";
    echo("<p> Adresse mail : " . htmlspecialchars($entreprise->getMail()) . " </p>");
    echo("<p> Telephone : " . htmlspecialchars($entreprise->getTelephone()) . " </p>");
    echo "</div>";
    echo "</a>";
}
echo '</div>';
echo  '</div>';
