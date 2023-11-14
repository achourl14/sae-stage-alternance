<?php

use App\Modele\Repository\EntrepriseRepository;

if(isset($_GET['numSiret'])){

    if(\App\Lib\ConnexionUtilisateur::estPersonnel()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?action=afficherGestionEntreprise"> < Retour à la gestion des entreprises </a>';
    }
    if(\App\Lib\ConnexionUtilisateur::estEtudiant()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?action=afficherMenuPostulerOffre"> < Retour aux candidatures </a>';
    }
    echo '<div class="offre_detail">';
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
    echo "<h1>".htmlspecialchars($entreprise->getNomEntreprise())."</h1>";
    echo "<h2> Numéro SIRET : " . htmlspecialchars($entreprise->getNumSiret()) . "</h2>";

    if(\App\Lib\ConnexionUtilisateur::estMaitreSA()){
        echo '<div class="boutonsGeneral">';
        echo '<a  href="controleurFrontal.php?action=afficherMAJEntreprise&numSiret='.$entreprise->getNumSiret().'"> Modifier les informations de l\'Entreprise </a>';
        echo '<a  href="controleurFrontal.php?action=afficherDeleteEntreprise&numSiret='.$entreprise->getNumSiret().'"> Supprimer le compte de l\'Entreprise </a>';
        echo '</div>';
    }

    echo '<hr/>';

    echo "<h3> Adresse de l'entreprise : </h3>";
    echo '<p>'. htmlspecialchars($entreprise->getAdresse()) .'</p>';
    echo "<h3> &#9993; Adresse mail </h3>";
    echo '<p>'. htmlspecialchars($entreprise->getMail()) .'</p>';
    echo "<h3> &#9742; Téléphone </h3>";
    echo '<p>'. htmlspecialchars($entreprise->getTelephone() ).'</p>';
    echo "<h3> Code APE </h3>";
    echo '<p>'.htmlspecialchars($entreprise->getCodeApe()) .'</p>';
    echo "<h3> Activité </h3>";
    echo '<p>'.htmlspecialchars($entreprise->getActivite()) .'</p>';
    echo "<h3> Interlocuteur Principal </h3>";
    echo '<p>'.htmlspecialchars($entreprise->getInterlocuteur()) .'</p>';
    echo '</div>';
    echo '</div>';
}else{
    echo '<div class="msgConfirmation"><p> ⚠️ Cette entreprise est introuvable ⚠️ </p></div>';
}
