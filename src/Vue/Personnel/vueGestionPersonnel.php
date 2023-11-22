<?php
use App\Modele\HTTP\Session;
use App\Modele\Repository\SecretariatRepository;
echo '<div class="toutesLesCartes">';
echo "<div class='title'> Gestion du Personnel de l'IUT </div>";

echo '<div class="contient">';
echo '<div class="content">';
$recherche = null;
    if(Session::getInstance()->contient("requeteFiltrePersonnel")){
        $recherche = Session::getInstance()->lire("requeteFiltrePersonnel");
    }
foreach((new SecretariatRepository())->getNomsColones() as $nomCol){
    if(!isset($recherche[$nomCol])){
        $recherche[$nomCol] = "";
    }
    if(!isset($recherche[(new SecretariatRepository())->getNomClePrimaire()])){
        $recherche[(new SecretariatRepository())->getNomClePrimaire()] = "";
    }
}
$m ="";
$s = "";
$t = "";
$a = "";
if(isset($recherche["role"])) {
    if ($recherche["role"] == "M") {
        $m = "selected";
    } else if ($recherche["role"] == "S") {
        $s = "selected";
    } else if ($recherche["role"] == "T") {
        $t = "selected";
    } else {
        $a = "selected";
    }
}

?>
    <form method="post" action="controleurFrontal.php?controleur=personnel&action=rechercherPersonnel">
        <div class="user-details">
            <div class="input-box-search">
                <span class="details">Login</span>
               <?php echo '<input type="text" name="idSecretariat" maxlength="50" value="'.$recherche["idSecretariat"].'" />'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Nom</span>
              <?php echo '<input type="text" placeholder="" name="nomSecretariat" maxlength="50" value="'.$recherche["nomSecretariat"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Prénom</span>
              <?php echo '<input type="text" placeholder="" name="prenomSecretariat" maxlength="50" value="'.$recherche["prenomSecretariat"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Adresse mail</span>
               <?php echo '<input type="email" placeholder="" name="mailSecretariat" maxlength="100" value="'.$recherche["adresseMail"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Téléphone</span>
               <?php echo '<input type="tel" placeholder="" name="telephoneSecretariat" pattern="[0-9]{10}" maxlength="10" value="'.$recherche["telephone"].'">'; ?>
            </div>
            <div class="input-box-search">
                <span class="details">Date de Naissance</span>
                <?php echo '<input type="date" placeholder="" name="dateDeNaissanceSecretariat" value="'.$recherche["dateDeNaissance"].'">'; ?>
            </div>
            <div class="input-box">
                <label class="details" for="roleCible"> Rôle </label>
                <select name="role" id="roleCible" required>
                    <option value="" <?php echo $a; ?>> Tout role </option>
                    <option value="T" <?php echo $t; ?>> Tuteur </option>
                    <option value="S" <?php echo $s; ?>> Secretariat </option>
                    <option value="M" <?php echo $m; ?>> Maitre Stage/Alternance (Admin) </option>
                </select>
            </div>
        </div>
        <div class="button">
            <input type="submit" value="Rechercher">
            <a href="controleurFrontal.php?controleur=personnel&action=supprimerFiltrePersonnel"> Rénitialiser </a>
        </div>
    </form>
    </div>
    </div>
<?php
echo "<div class='page'>";
echo "<div> <a class='' href='controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel&page=" . $pageActuelle - 1 . "'> page précédente </a> </div>";
if ($pageActuelle != 1) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel&page=" . $pageActuelle - 1 . "'>" . $pageActuelle - 1 . "</a> </div>";
}
echo "<div> <p> $pageActuelle </p> </div>";
if ($pageActuelle != $nbrePages) {
    echo "<div> <a class='' href='controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel&page=" . $pageActuelle + 1 . "'>" . $pageActuelle + 1 . "</a> </div>";
}
echo "<div> <a class='' href='controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel&page=" . $pageActuelle + 1 . "'> page suivante </a> </div>";
echo "</div>";

echo '<div class="page">';
echo "<div> <a class='' href='controleurFrontal.php?controleur=personnel&action=afficherSecretaire'> Ajouter un Personnel de l'IUT </a> </div>";
echo '</div>';

echo '<div class = "groupCartes">';
if ($personnels == null) {
    echo '<div class="msgConfirmation"><p> Aucun personnel de l\'IUT trouvé </p></div>';
} else {
    foreach ($personnels as $personnel) {

        echo "<a href='controleurFrontal.php?controleur=personnel&action=afficherDetailPersonnel&idSecretariat=" . $personnel->getIdSecretariat() . "'>";
        echo '<div class ="carte">';
        echo("<h1> login : " . htmlspecialchars($personnel->getIdSecretariat()) . "</h1>");
        echo("<p> Prénom : " . htmlspecialchars($personnel->getPrenomSecretariat()) . " </p>");
        echo("<p> Nom : " . htmlspecialchars($personnel->getNomSecretariat()) . " </p>");
        echo "</div>";
        echo "</a>";
    }
}
echo '</div>';
echo '</div>';
