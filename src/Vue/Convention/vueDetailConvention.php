<?php

use App\Modele\Repository\ConventionStageRepository;
use App\Modele\Repository\EntrepriseRepository;

if (isset($numConvention)) {
    echo '<a  class="boutonRetour" href="controleurFrontal.php"> < Retour à l\'Accueil </a>';
    echo '<div class="offre_detail">';
    $convention = (new ConventionStageRepository())->recupererParClePrimaire($numConvention);
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($convention->getSiret());
    echo "<h1> Convention de " . htmlspecialchars($convention->getPrenomEtu()) . " " . htmlspecialchars($convention->getNomEtu()) . "</h1>";
    echo "<div class='boutonsGeneral'>
            <div> <a href='controleurFrontal.php?controleur=convention&action=afficherMAJConvention&numConvention=".$numConvention."'> Modifier Convention </a> </div>
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

    echo "<div class='case'>";
    echo "<h3> Nom Entreprise </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $entreprise->getNomEntreprise() . "</p>";
    echo "</div>";
    echo "</div>";

    echo "<div class='case'>";
    echo "<h3> Numéro d'Étudiant </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>" . $convention->getNumEtudiant() . "</p>";
    echo "</div>";
    echo "</div>";
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
} else {
    echo '<div class="msgConfirmation"><p> ⚠️ Cette convention est introuvable ⚠️ </p></div>';
}