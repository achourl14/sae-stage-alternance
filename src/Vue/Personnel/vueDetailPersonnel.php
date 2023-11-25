<?php

use App\Modele\Repository\SecretariatRepository;

if(isset($_GET['login'])){

    $personnel = (new SecretariatRepository())->recupererParClePrimaire($_GET["login"]);

    $isTelephone = $personnel->getTelephone();
    $telephone = "Non Renseigné";
    if(isset($isTelephone)){
        $telephone = htmlspecialchars($personnel->getTelephone());
    }
    $isDateDeNaissance = $personnel->getDateDeNaissance();
    $dateDeNaissance = "Non Renseignée";
    if(isset($isDateDeNaissance)){
        $dateDeNaissance = htmlspecialchars($personnel->getDateDeNaissance());
    }

    $isMail = $personnel->getMail();
    $mail = "Non Renseigné";
    if(isset($isMail)){
        $mail = htmlspecialchars($isMail);
    }


    if(\App\Lib\ConnexionUtilisateur::estPersonnel()){
        echo '<a  class="boutonRetour" href="controleurFrontal.php?controleur=personnel&action=afficherGestionPersonnel"> < Retour à la gestion du Personnel </a>';
    }
    echo '<div class="offre_detail">';
    echo "<h1>".htmlspecialchars($personnel->getPrenomSecretariat())." ".htmlspecialchars($personnel->getNomSecretariat())."</h1>";
    echo "<h2> login : " . htmlspecialchars($personnel->getLogin()) . "</h2>";

    echo '<div class="boutonsGeneral">';
    echo '<a  href="controleurFrontal.php?controleur=personnel&action=afficherMAJPersonnel&login='.$personnel->getLogin().'"> Modifier les informations du Personnel de l\'IUT </a>';
    echo '<a  href="#"> Supprimer le compte du personnel de l\'IUT </a>';
    echo '</div>';
    //remplacer par la gestion des tuteurs
//    $stageTrouve = "";
//    if((new EtudiantRepository())->stageTrouve($personnel) == true){
//        $stageTrouve = "✅";
//    }
//    else{
//        $stageTrouve = "❌";
//    }
//
//    $alternanceTrouve = "";
//    if((new EtudiantRepository())->alternanceTrouve($personnel) == true){
//        $alternanceTrouve = "✅";
//    }
//    else{
//        $alternanceTrouve = "❌";
//    }
//
//    echo "<h3> Etudiant a trouvé un stage ". $stageTrouve ." </h3>";
//    echo "<h3> Etudiant a trouvé une alternance ". $alternanceTrouve ." </h3>";

    echo '<hr/>';

    echo "<h3> &#9993; Adresse mail </h3>";
    echo '<p>'. $mail .'</p>';
    echo "<h3> &#9742; Téléphone </h3>";
    echo '<p>'. $telephone .'</p>';
    echo "<h3> Date de naissance : </h3>";
    echo '<p>'. $dateDeNaissance .'</p>';
    echo '</div>';
}else{
    echo '<div class="msgConfirmation"><p> ⚠️ Ce Personnel de l\'IUT est introuvable ⚠️ </p></div>';
}
