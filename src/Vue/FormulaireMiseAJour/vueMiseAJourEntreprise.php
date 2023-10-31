<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Mise à jour Entreprise</title>
    <link rel="stylesheet" href="styles/css/style_inscription.css">
    <link rel="stylesheet" href="styles/css/style_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="contient">
<div class="container">
    <div class="title">Mise à jour des informations</div>
    <div class="content">
        <form method="post" name="inscription" action="controleurFrontal.php?action=MAJEntreprise">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Numéro SIRET</span>
                    <input type="text" name="num_siret" pattern="[0-9]{14}" value=<?php echo $entreprise->getNumSiret() ?> required minlength="14" maxlength="14" readonly/>
                </div>
                <div class="input-box">
                    <span class="details">Nom de l'entreprise</span>
                    <input type="text" value=<?php echo $entreprise->getNomEntreprise() ?> name="nom_entreprise" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Adresse</span>
                    <input type="text" value=<?php echo $entreprise->getAdresse() ?> name="adresse" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Telephone</span>
                    <input type="tel" value=<?php echo $entreprise->getTelephone() ?> name="telephone" pattern="[0-9]{10}" maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="details">Adresse mail</span>
                    <input type="email" name="mail" maxlength="100" value=<?php echo $entreprise->getMail() ?>  >
                </div>
                <div class="input-box">
                    <span class="details">Interlocuteur </span>
                    <input type="text" value=<?php echo $entreprise->getInterlocuteur() ?> name="interlocuteur" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Code APE</span>
                    <input type="text" value=<?php echo $entreprise->getCodeApe() ?> name="code_ape" pattern="[0-9]{5}" maxlength="5" required>
                </div>
                <div class="input-box">
                    <span class="details">Secteur d'Activité</span>
                    <input type="text" value=<?php echo $entreprise->getActivite() ?> name="activite" maxlength="50" required>
                </div>
                <?php
                if(!\App\Lib\ConnexionUtilisateur::estSecretariat()){
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