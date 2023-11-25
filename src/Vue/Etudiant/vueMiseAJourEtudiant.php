<?php use App\Lib\ConnexionUtilisateur; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Mise à jour Etudiant</title>
    <link rel="stylesheet" href="styles/css/style_inscription.css">
    <link rel="stylesheet" href="styles/css/style_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
$m = "";
$f = "";
if ($etudiant->getSexe() == "M") {
    $m = "selected";
} else {
    $f = "selected";
}
$r = "";
$i = "";
$d = "";
if ($etudiant->getParcours() == "RACDV") {
    $r = "selected";
} else if ($etudiant->getParcours() == "IAMSI") {
    $i = "selected";
} else {
    $d = "selected";
}
?>
<body>
<div class="contient">
    <div class="container">
        <div class="title">Mise à jour des informations</div>
        <div class="content">
            <form method="post" name="inscription"
                  action="controleurFrontal.php?controleur=etudiant&action=MAJEtudiant">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Login</span>
                        <input type="text" name="login" maxlength="11"
                               value=<?php echo $etudiant->getLogin() ?> required readonly/>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro Etudiant</span>
                        <input type="text" value=<?php echo $etudiant->getNumEtudiant() ?> "" name="num_etudiant"
                               maxlength="11" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Promotion</span>
                        <input type="text" value=<?php echo $etudiant->getPromotion() ?> "" name="promotion"
                               pattern="[0-3]{1}" maxlength="1"
                               required <?php if (!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()) {
                            echo 'readonly';
                        } ?>>
                    </div>
                    <div class="input-box">
                        <label class="details" for="parcoursCible"> Parcours</label>
                        <select name="parcours" id="parcoursCible" required>
                            <option value="RACDV" <?php echo $r; ?>> RACDV</option>
                            <option value="IAMSI" <?php echo $i; ?>> IAMSI</option>
                            <option value="DACS" <?php echo $d; ?>> DACS</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Groupe</span>
                        <input type="text" value=<?php echo $etudiant->getGroupe() ?> "" name="groupe" maxlength="2"
                               required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nom</span>
                        <input type="text" value=<?php echo $etudiant->getNom() ?> "" name="nom" maxlength="50"
                               required <?php if (!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()) {
                            echo 'readonly';
                        } ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Prénom</span>
                        <input type="text" name="prenom" maxlength="50" value=<?php echo $etudiant->getPrenom() ?> ""
                               required <?php if (!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()) {
                            echo 'readonly';
                        } ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de Naissance </span>
                        <input type="date" value=<?php echo $etudiant->getDateDeNaissance() ?> ""
                               name="date_de_naissance" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Mail Etudiant</span>
                        <input type="email" value=<?php echo $etudiant->getEmail() ?> "" name="mail" maxlength="100"
                               required <?php if (!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()) {
                            echo 'readonly';
                        } ?> >
                    </div>
                    <div class="input-box">
                        <span class="details">mail Personnel</span>
                        <input type="tel" placeholder="" value=<?php echo $etudiant->getMailPerso() ?> ""
                               name="mailPerso" maxlength="100" required>
                    </div>
                    <div class="input-box">
                        <label class="details" for="sex"> Sexe </label>
                        <select name="sexe" id="sex" required>
                            <option value="M" <?php echo $m; ?>>Masculin</option>
                            <option value="F" <?php echo $f; ?>> Féminin</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Téléphone</span>
                        <input type="tel" value=<?php echo $etudiant->getNumTel() ?> "" name="telephone"
                               pattern="[0-9]{10}" maxlength="10" required>
                    </div>
                    <?php
                    if (!ConnexionUtilisateur::estSecretariat() && !ConnexionUtilisateur::estMaitreSA() && $etudiant->getPremiereConnexion() != 0) {
                        echo '<div class="input-box">';
                        echo '<span class="details">Entrez votre mot de passe</span>';
                        echo '<input type="password" name="mdp" minlength="8" maxlength="50" required>';
                        echo '</div>';
                    }
                    if ($etudiant->getPremiereConnexion() == 0) {
                        echo '<div class="input-box">';
                        echo '<span class="details">Mot de passe </span>';
                        echo '<input type="password" placeholder="Entrez votre mot de passe" name="mdp" minlength="8" maxlength="50" required>';
                        echo '</div>';
                        echo '<div class="input-box">';
                        echo '<span class="details">Confirmez mot de passe</span>';
                        echo '<input type="password" placeholder="Confirmez votre mot de passe" name="mdp2" minlength="8" maxlength="50" required>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="button">
                    <input type="submit" value="Mettre à jour les informations">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>