<?php
use App\Modele\HTTP\Session;
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gestion des Etudiants </div>";

echo '<div class="contient">';
echo '<div class="content">';
$recherche = null;
    if(Session::getInstance()->contient("requeteFiltreEtudiant")){
        $recherche = Session::getInstance()->lire("requeteFiltreEtudiant");
    }
foreach((new \App\Modele\Repository\EtudiantRepository())->getNomsColones() as $nomCol){
    if(!isset($recherche[$nomCol])){
        $recherche[$nomCol] = "";
    }
    if(!isset($recherche[(new \App\Modele\Repository\EtudiantRepository())->getNomClePrimaire()])){
        $recherche[(new \App\Modele\Repository\EtudiantRepository())->getNomClePrimaire()] = "";
    }
}
?>
    <form method="post" action="controleurFrontal.php?controleur=etudiant&action=rechercherEtudiant">
        <div class="user-details">
            <div class="input-box-search">
                <span class="details">Login</span>
                   <?php echo '<input type="text" name="login" maxlength="50" value="'.$recherche["login"].'" />'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Numéro Etudiant</span>
              <?php echo  '<input type="text" placeholder="" name="num_etudiant" pattern="[0-9]{10}" maxlength="10" value="'.$recherche["codeEtudiant"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Nom de l'étudiant</span>
              <?php echo '<input type="text" placeholder="" name="nom_etudiant" maxlength="50" value="'.$recherche["nomEtudiant"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Prénom de l'étudiant</span>
              <?php echo '<input type="text" placeholder="" name="prenom" maxlength="50" value="'.$recherche["prenomEtudiant"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Adresse mail</span>
               <?php echo '<input type="email" placeholder="" name="mail" maxlength="100" value="'.$recherche["mailEtudiant"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Téléphone</span>
               <?php echo '<input type="tel" placeholder="" name="telephone" pattern="[0-9]{10}" maxlength="10" value="'.$recherche["telephoneEtudiant"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Promotion</span>
                <?php echo '<input type="text" placeholder="1 (année 1), 2 ou 3" name="promotion" pattern="[0-3]{1}" maxlength="1" value="'.$recherche["promotion"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Date de Naissance</span>
                <?php echo '<input type="date" placeholder="" name="date_de_naissance" value="'.$recherche["dateNaissanceEtudiant"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Groupe </span>
                <?php echo '<input type="text" placeholder="A1 ou Q1 ou G1..." name="groupe" maxlength="2" value="'.$recherche["groupe"].'">'; ?>
            </div>
<!--            <div class="input-box">-->
<!--                <label class="details" for="parcoursCible"> Parcours cible </label>-->
<!--                <select name="parcours" id="parcoursCible">-->
<!--                    <option value="Tout">Tous les parcours</option>-->
<!--                    <option value="RACDV"> RACDV </option>-->
<!--                    <option value="IAMSI"> IAMSI </option>-->
<!--                    <option value="DACS"> DACS </option>-->
<!--                </select>-->
<!--            </div>-->
        </div>
        <div class="button">
            <input type="submit" value="Rechercher">
            <a href="controleurFrontal.php?controleur=etudiant&action=supprimerFiltreEtudiant"> Rénitialiser </a>
        </div>
    </form>
    </div>
    </div>
<?php
echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";

if(\App\Lib\ConnexionUtilisateur::estMaitreSA() || \App\Lib\ConnexionUtilisateur::estSecretariat()){
    echo '<div class="page">';
    echo "<div> <a href='controleurFrontal.php?controleur=etudiant&action=afficherEtudiant'> Ajouter un étudiant </a> </div>";
    echo '</div>';
}

echo '<div class = "groupCartes">';
if ($etudiants == null) {
    if(\App\Lib\ConnexionUtilisateur::estTuteur()){
        echo '<div class="msgConfirmation"><p> Vous n\'avez pas d\'étudiant où vous êtes tuteur </p></div>';
    }else {
        echo '<div class="msgConfirmation"><p> Aucun Etudiants trouvé </p></div>';
    }
} else {
    foreach ($etudiants as $etudiant) {

        echo "<a href='controleurFrontal.php?controleur=etudiant&action=afficherDetailEtudiant&login=" . $etudiant->getLogin() . "'>";
        echo '<div class ="carte">';
        echo("<h1> Login : " . htmlspecialchars($etudiant->getLogin()) . "</h1>");
        echo("<p> Prénom : " . htmlspecialchars($etudiant->getPrenom()) . " </p>");
        echo("<p> Nom : " . htmlspecialchars($etudiant->getNom()) . " </p>");
        echo "</div>";
        echo "</a>";
    }
}
echo '</div>';
echo '</div>';
