<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo "$title" ?></title>
    <link rel="stylesheet" type="text/css" href="styles/css/style.css">
    <link rel="stylesheet" type="text/css" href="styles/css/style_form.css">
    <link rel="stylesheet" type="text/css" href="styles/css/consulterOffre.css">
    <link rel="stylesheet" type="text/css" href="styles/css/form_externe.css">
    <link rel="stylesheet" type="text/css" href="styles/css/form_supp.css">

    <script src="styles/js/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class="burger">
    <img id="imgburger" src="img/burger.png" alt="burger" width="50">
    <div id="menu2">
        <div><a href="">Formulaire</a></div>
        <div><a href="">A mettre</a></div>
        <div><a href="">A mettre</a></div>
    </div>
</div>

<?php

use App\Lib\ConnexionUtilisateur;
use App\ClassTest;

// BOUTON DEBUG

$accueil = "";
$form = "";
$offres = "";
$gestion = "";
$formExterne ="";

if($contenu == "index.html"){
    $accueil = "actuel";
}else if($contenu == "formulaireoffre.php"){
    $form = "actuel";
} else if($contenu == "Administration/vueGestionEtudiant.php" || $contenu == "Administration/vueGestionEntreprise.php" ){
    $gestion = "actuel";
} else if ($contenu == "vueOffres.php"){
    $offres = "actuel";
    $gestion = "actuel";
}else{
    $formExterne = 'actuel';
}

echo  '<nav>';
echo  '<img src="img/LogoIutMontpellier.png" />';
echo  '<h1> Stage / Alternance </h1>';
echo  '<div><a href="controleurFrontal.php" id='.$accueil.'>Accueil</a></div>';
if(ConnexionUtilisateur::estEntreprise()){
    echo  '<div><a href="controleurFrontal.php?action=afficherFormulaire" id='.$form.'>Creer Offre Par Entreprise</a></div>';
}
if(!ConnexionUtilisateur::estSecretariat()){
    echo '<div><a href="controleurFrontal.php?action=offres">offres</a></div>';
}

if(ConnexionUtilisateur::estSecretariat()){
    echo '<div><a id='.$gestion.'>Gestionnaire ▾</a>';
    echo '<div class="submenu">';
    echo '<a href="controleurFrontal.php?action=offres">Gestion offre</a>';
    echo '<a href="controleurFrontal.php?action=afficherGestionEtudiant">Gestion Etudiant</a>';
    echo '<a href="controleurFrontal.php?action=afficherGestionEntreprise">Gestion Entreprise</a>';
    echo '</div>';
    echo '</div>';
}
if(ConnexionUtilisateur::estEtudiant()){
    echo  '<div><a href="controleurFrontal.php?action=afficherFormulaireExterne" id='. $formExterne.'>Formulaire Externe</a></div>';
}

if(!ConnexionUtilisateur::estConnecte()){
    echo '<a class="connexion" id="inscrip" href="controleurFrontal.php?action=afficherInscription">Inscription</a>';
    echo '<a class="connexion" id="connex" href="controleurFrontal.php?action=afficherConnexion">Connexion</a>';
}else{
    echo '<div>';
    echo '<a id="buttonCompte">';
    echo '<div id="monCompte">';
    echo '<img src="img/compte.png"/>';
    echo '<p> Compte </p>';
    echo '</div>';
    echo '</a>';
    echo '<div class="submenu">';
    if(ConnexionUtilisateur::estEntreprise()){
        echo '<a href="controleurFrontal.php?action=afficherMAJEntreprise&numSiret='.ConnexionUtilisateur::getLoginUtilisateurConnecte().'">Configuration</a>';
    }else if(ConnexionUtilisateur::estEtudiant()){
        echo '<a href="controleurFrontal.php?action=afficherMAJEntreprise&numSiret='.ConnexionUtilisateur::getLoginUtilisateurConnecte().'">Configurationnnn</a>';
    }
    echo '<a href="controleurFrontal.php?action=seDeconnecter">Se déconnecter</a>';
    echo '</div>';
    echo '</div>';
}
echo '</nav>';
?>

<div class="contenupage">

    <?php
    if(ClassTest::$DEBUG == true){
        echo "<a href='controleurFrontal.php?action=estAdmin'>Admin</a>";
    }
    require __DIR__ . "/{$contenu}";
    ?>

</div>
<footer>
    <p>@ Copyright 2023 Hugo, Lucas, Alexandre, Xavier, Lisa </p>
</footer>
</body>
</html>
