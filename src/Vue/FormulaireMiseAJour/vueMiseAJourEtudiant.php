<?php use App\Lib\ConnexionUtilisateur;?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Mise à jour Etudiant</title>
    <link rel="stylesheet" href="styles/css/style_inscription.css">
    <link rel="stylesheet" href="styles/css/style_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="contient">
<div class="container">
    <div class="title">Mise à jour des informations</div>
    <div class="content">
        <form method="post" name="inscription" action="controleurFrontal.php?action=MAJEtudiant">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Code INE</span>
                    <input type="text" name="code_INE" maxlength="11" value=<?php echo $personnel->getLogin() ?> required readonly/>
                </div>
                <div class="input-box">
                    <span class="details">Numéro Etudiant</span>
                    <input type="text" value=<?php echo $personnel->getNumEtudiant() ?> name="num_etudiant" maxlength="11" required readonly>
                </div>
                <div class="input-box">
                    <span class="details">Promotion</span>
                    <input type="text" value=<?php echo $personnel->getPromotion() ?> name="promotion" pattern="[0-3]{1}" maxlength="1" required <?php if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){ echo 'readonly'; } ?>>
                </div>
                <div class="input-box">
                    <span class="details">Parcours</span>
                    <input type="text" value=<?php echo $personnel->getParcours() ?> name="parcours" maxlength="5" required <?php if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){ echo 'readonly'; } ?>>
                </div>
                <div class="input-box">
                    <span class="details">Groupe</span>
                    <input type="text" value=<?php echo $personnel->getGroupe() ?> name="groupe" maxlength="2" required <?php if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){ echo 'readonly'; } ?>>
                </div>
                <div class="input-box">
                    <span class="details">Nom</span>
                    <input type="text" value=<?php echo $personnel->getNom() ?> name="nom" maxlength="50" required <?php if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){ echo 'readonly'; } ?>>
                </div>
                <div class="input-box">
                    <span class="details">Prénom</span>
                    <input type="text" name="prenom" maxlength="50" value=<?php echo $personnel->getPrenom() ?>  required <?php if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){ echo 'readonly'; } ?>>
                </div>
                <div class="input-box">
                    <span class="details">Date de Naissance </span>
                    <input type="date" value=<?php echo $personnel->getDateDeNaissance() ?> name="date_de_naissance" required <?php if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){ echo 'readonly'; } ?>>
                </div>
                <div class="input-box">
                    <span class="details">Mail</span>
                    <input type="email" value=<?php echo $personnel->getEmail() ?> name="mail" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Téléphone</span>
                    <input type="tel" value=<?php echo $personnel->getNumTel() ?> name="telephone" pattern="[0-9]{10}" maxlength="10" required>
                </div>
                <?php
                if(!ConnexionUtilisateur::estSecretariat() || !ConnexionUtilisateur::estMaitreSA()){
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