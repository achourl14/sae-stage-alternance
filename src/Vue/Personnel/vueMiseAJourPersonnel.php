<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Mise à jour du Personnel</title>
    <link rel="stylesheet" href="styles/css/style_inscription.css">
    <link rel="stylesheet" href="styles/css/style_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
$m ="";
$s = "";
$t = "";
if($personnel->getRole() == "M"){
    $m= "selected";
}else if($personnel->getRole() == "S"){
    $s= "selected";
}else{
    $t = "selected";
}
?>
<div class="contient">
<div class="container">
    <div class="title">Mise à jour des informations</div>
    <div class="content">
        <form method="post" name="inscription" action="controleurFrontal.php?controleur=personnel&action=MAJPersonnel">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Login</span>
                    <input type="text" name="login" maxlength="50" value=<?php echo $personnel->getLogin() ?> required readonly/>
                </div>
                <div class="input-box">
                    <span class="details">Nom</span>
                    <input type="text" value=<?php echo $personnel->getNomSecretariat() ?> name="nomSecretariat" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Prénom</span>
                    <input type="text" name="prenomSecretariat" maxlength="50" value=<?php echo $personnel->getPrenomSecretariat() ?>  required >
                </div>
                <div class="input-box">
                    <span class="details">Date de Naissance </span>
                    <input type="date" value=<?php echo $personnel->getDateDeNaissance() ?> name="dateDeNaissanceSecretariat" required>
                </div>
                <div class="input-box">
                    <span class="details">Mail</span>
                    <input type="email" value=<?php echo $personnel->getMail() ?> name="mailSecretariat" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Téléphone</span>
                    <input type="tel" value=<?php echo $personnel->getTelephone() ?> name="telephoneSecretariat" pattern="[0-9]{10}" maxlength="10" required>
                </div>
                <div class="input-box">
                    <label class="details" for="roleCible"> Rôle </label>
                    <select name="role" id="roleCible" required>
                        <option value="T" <?php echo $t; ?>> Tuteur </option>
                        <option value="S" <?php echo $s; ?>> Secretariat </option>
                        <option value="M" <?php echo $m; ?>> Maitre Stage/Alternance (Admin) </option>
                    </select>
                </div>
                <?php
                if(!\App\Lib\ConnexionUtilisateur::estMaitreSA()){
                    echo '<div class="input-box">';
                    echo '<span class="details">Entrez votre mot de passe</span>';
                    echo '<input type="password" name="mdp" minlength="8" maxlength="50" required>';
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