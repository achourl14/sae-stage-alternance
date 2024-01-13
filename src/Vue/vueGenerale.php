<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo "$title" ?></title>
    <link rel="stylesheet" type="text/css" href="styles/css/style.css">
    <link rel="stylesheet" type="text/css" href="styles/css/style_form.css">
    <link rel="stylesheet" type="text/css" href="styles/css/consulterOffre.css">
    <link rel="stylesheet" type="text/css" href="styles/css/form_externe.css">
    <link rel="stylesheet" type="text/css" href="styles/css/mesCandidatures.css">
    <link rel="stylesheet" type="text/css" href="styles/css/form_supp.css">
    <link rel="stylesheet" type="text/css" href="styles/css/tableauDeBord.css">
    <script src="styles/js/scriptFormulaireStageExterne.js"></script>
    <script src="styles/js/onglet.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class="burger">
    <img id="imgburger" src="img/burger.png" alt="burger" width="50">
    <div id="menu2">
        <div><a href="controleurFrontal.php">Accueil</a></div>
        <div><a href="controleurFrontal.php?action=offres">Offres</a></div>
        <div><a href="">A mettre</a></div>
    </div>
</div>

<?php

use App\Lib\ConnexionUtilisateur;
use App\Modele\ClassTest;

// BOUTON DEBUG

$accueil = "";
$form = "";
$offres = "";
$gestion = "";
$formExterne = "";
$compte = "";

if ($contenu == "index.php") {
    $accueil = "actuel";
} else if ($contenu == "formulaireoffre.php") {
    $form = "actuel";
} else if ($contenu == "Administration/vueGestionEtudiant.php" || $contenu == "Administration/vueGestionEntreprise.php") {
    $gestion = "actuel";
} else if ($contenu == "vueOffres.php") {
    $offres = "actuel";
} else if ($contenu == "formulaireOffreExterneStage.html") {
    $formExterne = 'actuel';
} else {
    $compte = 'actuel';
}

echo '<nav>';

echo '<div id="logoSite">';
echo '<img src="img/LogoIutMontpellier.png" />';
echo '<h1> Stage / Alternance </h1>';
echo '</div>';

echo '<div id="navButton">';
echo '<div><a href="controleurFrontal.php" id=' . $accueil . '>Accueil</a></div>';
if (ConnexionUtilisateur::estMaitreSA()) {
    echo '<div><a href="controleurFrontal.php?controleur=personnel&action=afficherTableauDeBord">Tableau De Bord</a></div>';
}
if (ConnexionUtilisateur::estEntreprise()) {
    echo '<div><a href="controleurFrontal.php?controleur=offre&action=afficherFormulaire" id=' . $form . '>Creer Offre</a></div>';
    echo '<div><a  id="' . $offres . '" href="controleurFrontal.php?controleur=offre&action=offres"> Mes offre</a></div>';
}
if (ConnexionUtilisateur::estEtudiant() || ConnexionUtilisateur::estSecretariat()) {
    echo '<div><a  id="' . $offres . '" href="controleurFrontal.php?controleur=offre&action=offres">offres</a></div>';
}
if (ConnexionUtilisateur::estEtudiant()) {
    $etudiant = (new \App\Modele\Repository\EtudiantRepository())->recupererParClePrimaire(ConnexionUtilisateur::getLoginUtilisateurConnecte());
    if ($etudiant != null) {
        if ((new \App\Modele\Repository\ConventionStageRepository())->recupererDepuisNumEtudiant($etudiant->getNumEtudiant()) != null) {
            echo "<div><a href='controleurFrontal.php?controleur=convention&action=afficherMAJConventionDepuisEtudiant'>Convention</a></div>";
        }
    }
}
if(ConnexionUtilisateur::estTuteur()){
    echo '<div><a href="controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant">Suivi Etudiants</a></div>';
}

if (/*ConnexionUtilisateur::estMaitreSA() || */ConnexionUtilisateur::estSecretariat()) {
    echo '<div><a id=' . $gestion . '>Gestionnaire ▾</a>';
    echo '<div class="submenu">';
    /*if (ConnexionUtilisateur::estMaitreSA()) {
        echo '<a href="controleurFrontal.php?controleur=offre&action=offres">Gestion offre</a>';
        echo '<a href="controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise">Gestion Entreprise</a>';
        echo '<a href="controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel">Gestion du personnel de l\'IUT</a>';
    }*/
    echo '<a href="controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant">Gestion Etudiant</a>';
    echo '<a href="controleurFrontal.php?controleur=convention&action=afficherGestionConvention">Gestion des brouillons des Conventions</a>';
    echo '<a href="controleurFrontal.php?controleur=convention&action=afficherGestionConventionFinale">Gestion des Conventions Finales</a>';
    echo '<a href="controleurFrontal.php?controleur=convention&action=afficherGestionConventionAlternanceFinale">Gestion des Conventions Alternance Finales</a>';

    echo '</div>';
    echo '</div>';
}

if (ConnexionUtilisateur::estMaitreSA()){
    echo '<div><a id=' . $gestion . '>Gestion des entreprises▾</a>';
    echo '<div class="submenu">';
    echo '<a href="controleurFrontal.php?controleur=offre&action=offres">Gestion offre</a>';
    echo '<a href="controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise">Gestion Entreprise</a>';
    echo '</div>';
    echo '</div>';

    echo '<div><a id=' . $gestion . '>Gestion des conventions▾</a>';
    echo '<div class="submenu">';
    echo '<a href="controleurFrontal.php?controleur=convention&action=afficherGestionConvention">Gestion des brouillons des Conventions</a>';
    echo '<a href="controleurFrontal.php?controleur=convention&action=afficherGestionConventionFinale">Gestion des Conventions Finales</a>';
    echo '<a href="controleurFrontal.php?controleur=convention&action=afficherGestionConventionAlternanceFinale">Gestion des Conventions Alternance Finales</a>';
    echo '</div>';
    echo '</div>';

    echo '<div><a id=' . $gestion . '>Gestion des personnes▾</a>';
    echo '<div class="submenu">';
    echo '<a href="controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel">Gestion du personnel de l\'IUT</a>';
    echo '<a href="controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant">Gestion Etudiant</a>';
    echo '</div>';
    echo '</div>';

}

if (ConnexionUtilisateur::estEtudiant()) {
    echo '<div><a href="controleurFrontal.php?controleur=offre&action=afficherFormulaireExterne" id=' . $formExterne . '>Formulaire Externe</a></div>';
}

if (!ConnexionUtilisateur::estConnecte()) {
    echo '</div>';
    echo "<div class='comptesButton'>";
    echo '<a class="connexion"  href="controleurFrontal.php?controleur=generique&action=afficherInscription">Inscription</a>';
    echo '<a class="connexion"  href="controleurFrontal.php?controleur=generique&action=afficherConnexion">Connexion</a>';
    echo '</div>';
} else {
    echo '<div>';
    echo '<a id="buttonCompte">';
    echo '<div id="monCompte">';
    echo '<img src="img/compte.png"/>';
    if (ConnexionUtilisateur::estEtudiant()) {
        echo '<p> Etudiant(' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . ') </p>';
    } else if (ConnexionUtilisateur::estEntreprise()) {
        echo '<p> Entreprise(' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . ') </p>';
    } else if (ConnexionUtilisateur::estMaitreSA()) {
        echo '<p> Administrateur(' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . ') </p>';
    } else if (ConnexionUtilisateur::estPersonnel()) {
        echo '<p> Personnel(' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . ') </p>';
    }
    echo '</div>';
    echo '</a>';
    echo '<div class="submenu submenuCompte">';
    if (ConnexionUtilisateur::estPersonnel()) {
        echo '<a href="controleurFrontal.php?controleur=personnel&action=afficherMAJPersonnel&login=' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . '">Configuration</a>';
    }
    if (ConnexionUtilisateur::estMaitreSA()) {
        echo '<a href="controleurFrontal.php?controleur=generique&action=afficherLDAP"> Mettre à jour LDAP </a>';
    }
    if (ConnexionUtilisateur::estEntreprise()) {
        echo '<a href="controleurFrontal.php?controleur=entreprise&action=afficherMAJEntreprise&numSiret=' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . '">Configuration</a>';
    } else if (ConnexionUtilisateur::estEtudiant()) {
        echo '<a href="controleurFrontal.php?controleur=offre&action=afficherMenuPostulerOffre">Candidatures</a>';
        echo '<a href="controleurFrontal.php?controleur=etudiant&action=afficherMAJEtudiant&login=' . ConnexionUtilisateur::getLoginUtilisateurConnecte() . '">Configuration</a>';
    }
    echo '<a href="controleurFrontal.php?controleur=generique&action=seDeconnecter">Se déconnecter</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

echo '</nav>';
?>

<div class="contenupage">

    <?php
    if (ClassTest::$DEBUG == true && !ConnexionUtilisateur::estConnecte()) {
        echo "<a href='controleurFrontal.php?controleur=generique&action=estAdmin'>Admin</a>";
    }
    require __DIR__ . "/{$contenu}";
    ?>

</div>
<footer>
    <p>@ Copyright 2023 Hugo, Lucas, Alexandre, Xavier, Lisa </p>
</footer>
</body>
</html>
