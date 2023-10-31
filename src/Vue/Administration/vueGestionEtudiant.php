<?php

echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gestion des Etudiants </div>";

    echo '<div class="contient">';
    echo '<div class="content">';
?>
<form method="post" action="controleurFrontal.php?action=rechercherEtudiant">
            <div class="user-details">
                <div class="input-box-search">
                    <span class="details">Code INE</span>
                    <input type="text" name="code_INE" pattern="[0-9]{14}" minlength="14" maxlength="14"/>
                </div>
                <div class="input-box-search">
                    <span class="details">Numéro Etudiant</span>
                    <input type="text" placeholder="" name="num_etudiant" pattern="[0-9]{10}" maxlength="10">
                </div>
                <div class="input-box-search">
                    <span class="details">Nom de l'étudiant</span>
                    <input type="text" placeholder="" name="nom_etudiant" maxlength="50">
                </div>
                <div class="input-box-search">
                    <span class="details">Prénom de l'étudiant</span>
                    <input type="text" placeholder="" name="prenom" maxlength="50">
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
                    <span class="details">Promotion</span>
                    <input type="text" placeholder="1 (année 1), 2 ou 3" name="promotion" pattern="[0-3]{1}" maxlength="1">
                </div>
                <div class="input-box-search">
                    <span class="details">Date de Naissance</span>
                    <input type="date" placeholder="" name="date_de_naissance">
                </div>
                <div class="input-box-search">
                    <span class="details">Groupe </span>
                    <input type="text" placeholder="A1 ou Q1 ou G1..." name="groupe" maxlength="2">
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
echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEtudiant&page=". $pageActuelle-1 ."'> page précédente </a> </div>";
if($pageActuelle != 1){
    echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEtudiant&page=". $pageActuelle-1 ."'>". $pageActuelle-1 ."</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEtudiant&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?action=afficherGestionEtudiant&page=". $pageActuelle+1 ."'> page suivante </a> </div>";
echo "</div>";
echo '<div class = "groupCartes">';
foreach ($etudiants as $etudiant) {

    echo "<a href='controleurFrontal.php?action=afficherDetailEtudiant&codeINE=" . $etudiant->getCodeINE() . "'>";
    echo '<div class ="carte">';
    echo("<h1> Numéro INE : " . htmlspecialchars($etudiant->getCodeINE()) . "</h1>");
    echo "<h2> code Etudiant : ". htmlspecialchars($etudiant->getNumEtudiant()) . " </h2>";
    echo("<p> Prénom : " . htmlspecialchars($etudiant->getPrenom()) . " </p>");
    echo("<p> Nom : " . htmlspecialchars($etudiant->getNom()) . " </p>");
    echo "</div>";
    echo "</a>";
}
echo '</div>';
echo  '</div>';
