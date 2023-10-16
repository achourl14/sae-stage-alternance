<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo "$title" ?></title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="styles/consulterOffre.css">
    <link rel="stylesheet" type="text/css" href="styles/style_form.css">
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
$accueil = "";
$form = "";
$offres = "";
$valider = "";
$formExterne ="";

if($contenu == "index.html"){
    $accueil = "actuel";
}else if($contenu == "formulaireoffre.html"){
    $form = "actuel";
} else if($contenu == "vueValiderOffre.php"){
    $valider = "actuel";
} else if ($contenu == "vueOffres.php"){
    $offres = "actuel";
}

echo  '<nav>';
echo  '<img src="img/LogoIutMontpellier.png" />';
echo  '<h1> Stage / Alternance </h1>';
echo  '<div><a href="controleurFrontal.php" id='.$accueil.'>Accueil</a></div>';
echo  '<div><a href="controleurFrontal.php?action=afficherFormulaire" id='.$form.'>Creer Offres Par Entreprise</a></div>';
echo  '<div><a href="controleurFrontal.php?action=consulterOffre" id='.$offres.'>Offres</a></div>';
echo  '<div><a href="controleurFrontal.php?action=consulterOffreSecretaire" id='.$valider.'>Valider offre</a></div>';
echo  '<div><a href="" id='. $formExterne.'>Formulaire Externe</a></div>'
?>
    <a class="connexion" id="inscrip" href="controleurFrontal.php?action=afficherInscription">Inscription</a>
    <a class="connexion" id="connex" href="controleurFrontal.php?action=afficherConnexion">Connexion</a>
</nav>


<div class="contenupage">
    <?php
    require __DIR__ . "/{$contenu}";
    ?>

</div>
<footer>
    <p>@ Copyright 2023 Hugo, Lucas, Alexandre, Xavier, Lisa </p>
</footer>
</body>
</html>
