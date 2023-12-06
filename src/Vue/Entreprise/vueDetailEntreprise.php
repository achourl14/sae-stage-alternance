<?php

use App\Modele\Repository\EntrepriseRepository;

if(isset($_GET['numSiret'])){

    if(\App\Lib\ConnexionUtilisateur::estPersonnel()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?controleur=entreprise&action=afficherGestionEntreprise"> < Retour à la gestion des entreprises </a>';
    }
    if(\App\Lib\ConnexionUtilisateur::estEtudiant()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?controleur=etudiant&action=afficherMenuPostulerOffre"> < Retour aux candidatures </a>';
    }
    echo '<div class="offre_detail">';
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
    echo "<h1>".htmlspecialchars($entreprise->getNomEntreprise())."</h1>";
    echo "<h2> Numéro SIRET : " . htmlspecialchars($entreprise->getNumSiret()) . "</h2>";

    if(\App\Lib\ConnexionUtilisateur::estMaitreSA()){
        echo '<div class="boutonsGeneral">';
        echo '<a  href="controleurFrontal.php?controleur=entreprise&action=afficherMAJEntreprise&numSiret='.$entreprise->getNumSiret().'"> Modifier les informations de l\'Entreprise </a>';
        echo '<a  href="controleurFrontal.php?controleur=entreprise&action=afficherDeleteEntreprise&numSiret='.$entreprise->getNumSiret().'"> Supprimer le compte de l\'Entreprise </a>';
        echo '</div>';
    }

    echo '<hr/>';

    echo "<h3> Informations Générale sur l\'entreprise </h3>";
    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Adresse de l'entreprise : </h3>";
    echo "<div class='supcase'>";
    echo '<p class="case">'. htmlspecialchars($entreprise->getAdresse()) .'</p>';
    echo "</div>";
    echo '</div>';

    echo "<div class='case'>";
    echo "<h3> &#9993; Adresse mail </h3>";
    echo "<div class='supcase'>";
    echo '<p class="case">'. htmlspecialchars($entreprise->getMail()) .'</p>';
    echo "</div>";
    echo '</div>';

    echo "<div class='case'>";
    echo "<h3> &#9742; Téléphone </h3>";
    echo "<div class='supcase'>";
    echo '<p class="case">'. htmlspecialchars($entreprise->getTelephone() ).'</p>';
    echo "</div>";
    echo '</div>';
    echo '</div>';

    echo "<h3> Informations complémentaire </h3>";
    echo "<div class='detailLigne'>";
    echo "<div class='case'>";
    echo "<h3> Code APE </h3>";
    echo "<div class='supcase'>";
    echo '<p class="case">'.htmlspecialchars($entreprise->getCodeApe()) .'</p>';
    echo "</div>";
    echo '</div>';

    echo "<div class='case'>";
    echo "<h3> Activité </h3>";
    echo "<div class='supcase'>";
    echo '<p class="case">'.htmlspecialchars($entreprise->getActivite()) .'</p>';
    echo "</div>";
    echo '</div>';

    echo "<div class='case'>";
    echo "<h3> Interlocuteur Principal </h3>";
    echo "<div class='supcase'>";
    echo '<p class="case">'.htmlspecialchars($entreprise->getInterlocuteur()) .'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}else{
    echo '<div class="msgConfirmation"><p> ⚠️ Cette entreprise est introuvable ⚠️ </p></div>';
}
