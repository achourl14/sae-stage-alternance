<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo "$title" ?></title>
    <link rel="stylesheet" type="text/css" href="styles/css/style.css">
    <link rel="stylesheet" type="text/css" href="styles/css/consulterOffre.css">
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

<nav>
    <img src="img/LogoIutMontpellier.png" />
    <h1> Stage / Alternance </h1>
    <div><a id="nav-accueil" href="controleurFrontal.php">Accueil</a></div>
    <div><a id="nav-form" href="controleurFrontal.php?action=afficherFormulaire"">Creer Offres Par Entreprise</a></div>
    <div><a id="nav-consulter" href="controleurFrontal.php?action=consulterOffre">Offres</a></div>
    <div><a href="controleurFrontal.php?action=afficherFormulaireExterne">Formulaire externe </a></div>
    <div><a href="">A mettre</a></div>
    <a class="connexion" id="inscrip" href="controleurFrontal.php?action=afficherInscription">Inscription</a>
    <a class="connexion" id="connex" href="controleurFrontal.php?action=afficherInscription">Connexion</a>
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
