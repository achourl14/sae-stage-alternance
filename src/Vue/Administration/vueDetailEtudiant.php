<?php

use App\Modele\Repository\EtudiantRepository;

if(isset($_GET['codeINE'])){
    if(\App\Lib\ConnexionUtilisateur::estPersonnel()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?action=afficherGestionEtudiant"> < Retour à la gestion des étudiants </a>';
    }
    echo '<div class="offre_detail">';
    $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET["codeINE"]);
    echo "<h1>".htmlspecialchars($etudiant->getPrenom())." ".htmlspecialchars($etudiant->getNom())."</h1>";
    echo "<h2> Numéro INE : " . htmlspecialchars($etudiant->getCodeINE()) . "</h2>";
    echo "<h2> Numéro Etudiant : ". htmlspecialchars($etudiant->getNumEtudiant()) ."</h2>";

    echo '<div class="boutonsGeneral">';
    echo '<a  href="controleurFrontal.php?action=afficherMAJEtudiant&codeINE='.$etudiant->getCodeINE().'"> Modifier les informations de l\'Etudiant </a>';
    echo '<a  href="#"> Supprimer le compte de l\'Etudiant </a>';
    echo '</div>';
    $stageTrouve = "";
    if((new EtudiantRepository())->stageTrouve($etudiant) == true){
        $stageTrouve = "✅";
    }
    else{
        $stageTrouve = "❌";
    }

    $alternanceTrouve = "";
    if((new EtudiantRepository())->alternanceTrouve($etudiant) == true){
        $alternanceTrouve = "✅";
    }
    else{
        $alternanceTrouve = "❌";
    }

    echo "<h3> Etudiant a trouvé un stage ". $stageTrouve ." </h3>";
    echo "<h3> Etudiant a trouvé une alternance ". $alternanceTrouve ." </h3>";

    echo '<hr/>';

    echo "<h3> &#9993; Adresse mail </h3>";
    echo '<p>'. htmlspecialchars($etudiant->getEmail()) .'</p>';
    echo "<h3> &#9742; Téléphone </h3>";
    echo '<p>'. htmlspecialchars($etudiant->getNumTel() ).'</p>';
    echo "<h3> Date de naissance : </h3>";
    echo '<p>'. htmlspecialchars($etudiant->getDateDeNaissance()) .'</p>';
    echo "<h3> Année de sa promotion / Groupe / Parcours </h3>";
    echo '<p> Année '. htmlspecialchars($etudiant->getPromotion()) .', Groupe '. htmlspecialchars($etudiant->getGroupe()) .', Parcours '.htmlspecialchars($etudiant->getParcours()) .'</p>';
    echo '</div>';
    echo '</div>';
}else{
    echo '<div class="msgConfirmation"><p> ⚠️ Cet étudiant est introuvable ⚠️ </p></div>';
}
