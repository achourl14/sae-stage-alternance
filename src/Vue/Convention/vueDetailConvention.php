<?php

use App\Modele\Repository\ConventionStageRepository;
use App\Modele\Repository\EntrepriseRepository;

if (isset($convention)) {
    echo '<a  class="boutonRetour" href="controleurFrontal.php"> < Retour à l\'Accueil </a>';
    echo '<div class="offre_detail">';
    echo "<h1> Convention de " . htmlspecialchars($convention->getPrenomEtu()) . " " . htmlspecialchars($convention->getNomEtu()) . "</h1>";
    echo "<div class='boutonsGeneral'>
            <div> <a href='controleurFrontal.php?controleur=convention&action=afficherMAJConvention&numConvention=".$convention->getNumConvention()."'> Modifier Convention </a> </div>
           </div>";
    echo "<hr/>";

    echo "<h2> Informations Générale : </h2>";

    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Numéro de Convention </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getNumConvention() . "</p>";
    echo "</div>";
    echo "</div>";

    if($entreprise != null){
        echo "<a class='carteCliquable' href='controleurFrontal.php?controleur=entreprise&action=afficherDetailEntreprise&numSiret=" . $entreprise->getNumSiret() . "'>";
        echo "<div class='case'>";
        echo "<h3> Nom Entreprise </h3>";
        echo "<div class='supcase'>";
        echo "<p class='case'>" . $entreprise->getNomEntreprise() . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
    }else{
        echo "<div class='case'>";
        echo "<h3> Numéro siret Entreprise </h3>";
        echo "<div class='supcase'>";
        echo "<p class='case'>" . $convention->getSiret() . "</p>";
        echo "</div>";
        echo "</div>";
    }

    if($etudiant != null){
        echo "<a class='carteCliquable' href='controleurFrontal.php?controleur=etudiant&action=afficherDetailEtudiant&login=" . $convention->getNumEtudiant() . "'>";
        echo "<div class='case'>";
        echo "<h3> Étudiant </h3>";
        echo "<div class='supcase'>";
        echo "<p class='case'>" . $convention->getNomEtu()  . " " . $convention->getPrenomEtu()." (" . $convention->getNumEtudiant() . ") </p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }else{
        echo "</div>";
        echo "<h2> Informations étudiant : </h2>";
        echo "<div class='detailLigne'>";
        echo "<div class='case'>";
        echo "<h3> Nom de l'Étudiant </h3>";
        echo "<div class='supcase'>";
        echo "<p class='case'>" . $convention->getNomEtu() . "</p>";
        echo "</div>";
        echo "</div>";

        echo "<div class='case'>";
        echo "<h3> Prénom de l'Étudiant </h3>";
        echo "<div class='supcase'>";
        echo "<p class='case'>" . $convention->getPrenomEtu() . "</p>";
        echo "</div>";
        echo "</div>";

        echo "<div class='case'>";
        echo "<h3> Mail Universitaire de l'Étudiant </h3>";
        echo "<div class='supcase'>";
        echo "<p class='case'>" . $convention->getMailUniversitaireEtu() . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }




    echo "<h2> Informations Generale : </h2>";
    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Ville </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getCommuneEtabAcceuil() . "</p>";
    echo "</div>";
    echo "</div>";


    echo "<div class='case'>";
    echo "<h3> Thématique </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getThematique() . "</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='case'>";
    echo "<h3> Année </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getAnneeUniversitaire() . "</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    echo "<h2> Dates : </h2>";
    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Date de Debut </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getDateDebut() . "</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='case'>";
    echo "<h3> Date de Fin </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getDateFin() . "</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='case'>";
    echo "<h3> Intérruption ? </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getInterruption() . "</p>";
    echo "</div>";
    echo "</div>";
    echo '</div>';

    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Date de Création Convention </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getDateCreationConvention() . "</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='case'>";
    echo "<h3> Date de Modification de la Convention </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getDateModificationConvention() . "</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='case'>";
    echo "<h3> Durée du Stage </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getDuree() . "</p>";
    echo "</div>";
    echo "</div>";
    echo '</div>';

    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Detail Projet </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getDetailProjet() . "</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo '<div class="msgConfirmation"><p> ⚠️ Cette convention est introuvable ⚠️ </p></div>';
}