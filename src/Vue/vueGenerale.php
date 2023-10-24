<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo "$title" ?></title>
    <link rel="stylesheet" type="text/css" href="styles/css/style.css">
    <link rel="stylesheet" type="text/css" href="styles/css/style_form.css">
    <link rel="stylesheet" type="text/css" href="styles/css/consulterOffre.css">
    <link rel="stylesheet" type="text/css" href="styles/css/form_externe.css">
    <script src="styles/js/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class="burger">
    <img src="img/burger.png" alt="burger" width="50">
    <div id="menu2">
        <div><a href="">Formulaire</a></div>
        <div><a href="">A mettre</a></div>
        <div><a href="">A mettre</a></div>
    </div>
</div>

<?php

use App\Lib\ConnexionUtilisateur;

// BOUTON DEBUG
$DEBUG = true;

$accueil = "";
$form = "";
$offres = "";
$valider = "";
$formExterne ="";

if($contenu == "index.html"){
    $accueil = "actuel";
}else if($contenu == "formulaireoffre.php"){
    $form = "actuel";
} else if($contenu == "vueValiderOffre.php"){
    $valider = "actuel";
} else if ($contenu == "vueOffres.php"){
    $offres = "actuel";
}else{
    $formExterne = 'actuel';
}

echo  '<nav>';
echo  '<img src="img/LogoIutMontpellier.png" />';
echo  '<h1> Stage / Alternance </h1>';
echo  '<div><a href="controleurFrontal.php" id='.$accueil.'>Accueil</a></div>';
if(ConnexionUtilisateur::estEntreprise()){
    echo  '<div><a href="controleurFrontal.php?action=afficherFormulaire" id='.$form.'>Creer Offres Par Entreprise</a></div>';
}
echo  '<div><a href="controleurFrontal.php?action=consulterOffre" id='.$offres.'>Offres</a></div>';
if(ConnexionUtilisateur::estSecretariat()){
    echo  '<div><a href="controleurFrontal.php?action=consulterOffreSecretaire" id='.$valider.'>Valider offre</a></div>';
}
if(ConnexionUtilisateur::estEtudiant()){
    echo  '<div><a href="controleurFrontal.php?action=afficherFormulaireExterne" id='. $formExterne.'>Formulaire Externe</a></div>';
}

if(!ConnexionUtilisateur::estConnecte()){
    echo '<a class="connexion" id="inscrip" href="controleurFrontal.php?action=afficherInscription">Inscription</a>';
    echo '<a class="connexion" id="connex" href="controleurFrontal.php?action=afficherConnexion">Connexion</a>';
}else{
    echo '<a class="connexion" id="connex" href="controleurFrontal.php?action=seDeconnecter">Se déconnecter</a>';
}

?>
</nav>


<div class="contenupage">

    <?php
    if($DEBUG == true){
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
