<?php

use App\Modele\Repository\EtudiantRepository;

if(isset($_GET['login'])){
    $etudiant = (new EtudiantRepository())->recupererParClePrimaire($_GET["login"]);

    $isCodeEtudiant = $etudiant->getNumEtudiant();
    $codeEtudiant = "Non Renseigné";
    if(isset($isCodeEtudiant)){
        $codeEtudiant = htmlspecialchars($isCodeEtudiant);
    }
    $isTelephone = $etudiant->getNumTel();
    $telephone = "Non Renseigné";
    if(isset($isTelephone)){
        $telephone = htmlspecialchars($isTelephone);
    }
    $isDateDeNaissance = $etudiant->getDateDeNaissance();
    $dateDeNaissance = "Non Renseignée";
    if(isset($isDateDeNaissance)){
        $dateDeNaissance = htmlspecialchars($etudiant->getDateDeNaissance());
    }

    $isMail = $etudiant->getEmail();
    $mail = "Non Renseigné";
    if(isset($isMail)){
        $mail = htmlspecialchars($isMail);
    }

    $isGroupe = $etudiant->getGroupe();
    $groupe = "Non Renseigné";
    if(isset($isGroupe)){
        $groupe = htmlspecialchars($isGroupe);
    }

    $isParcours = $etudiant->getParcours();
    $parcours = "Non Renseigné";
    if(isset($isParcours)){
        $parcours = htmlspecialchars($isParcours);
    }
    if(\App\Lib\ConnexionUtilisateur::estPersonnel()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?controleur=etudiant&action=afficherGestionEtudiant"> < Retour à la gestion des étudiants </a>';
    }
    echo '<div class="offre_detail">';
    echo "<h1>".htmlspecialchars($etudiant->getPrenom())." ".htmlspecialchars($etudiant->getNom())."</h1>";
    echo "<h2> Login : " . htmlspecialchars($etudiant->getLogin()) . "</h2>";
    echo "<h2> Numéro Etudiant : ". $codeEtudiant ."</h2>";

    echo '<div class="boutonsGeneral">';
    echo '<a  href="controleurFrontal.php?controleur=etudiant&action=afficherMAJEtudiant&login='.$etudiant->getLogin().'"> Modifier les informations de l\'Etudiant </a>';
    echo '<a  href="controleurFrontal.php?controleur=etudiant&action=afficherDeleteEtu&login='.$etudiant->getLogin().'"> Supprimer le compte de l\'Etudiant </a>';
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
    echo '<p>'. $mail .'</p>';
    echo "<h3> &#9742; Téléphone </h3>";
    echo '<p>'. $telephone.'</p>';
    echo "<h3> Date de naissance : </h3>";
    echo '<p>'. $dateDeNaissance .'</p>';
    echo "<h3> Année de sa promotion / Groupe / Parcours </h3>";
    echo '<p> Année '. htmlspecialchars($etudiant->getPromotion()) .', Groupe '. $groupe .', Parcours '. $parcours .'</p>';
    echo '</div>';
    echo '</div>';
}else{
    echo '<div class="msgConfirmation"><p> ⚠️ Cet étudiant est introuvable ⚠️ </p></div>';
}
