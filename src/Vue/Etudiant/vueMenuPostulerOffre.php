<?php

use App\Modele\Repository\EntrepriseRepository;

echo "<div class='title'> Vos candidatures </div>";
if($offresCandidate == null){
    echo '<div class="msgConfirmation"><p> Vous n\'avez postuler à aucune offre </p></div>';
}else{
    echo "<div class='toutesCandidature'>";
    foreach ($offresCandidate as $offre) {
        echo "<a href='controleurFrontal.php?controleur=offre&action=afficherDetail&idOffre=" . $offre->getIdOffre() . "'>";
        echo "<div class='offre_candidature'>";
        echo "<div>";
        $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise());
        echo "<h1>".htmlspecialchars($offre->getNomOffre())."</h1>";
        echo "<h2> Entreprise : " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h2>";
        echo "<h3> id de l'offre : ".$offre->getIdOffre()."</h3>";
        echo '</div>';

        $postuler = (new \App\Modele\Repository\PostulerRepository())->recupererParClePrimaire(\App\Lib\ConnexionUtilisateur::getLoginUtilisateurConnecte(),$offre->getIdOffre());
        if($postuler != null) {
            echo "<div class='etat'>";
            if ($postuler->getEtat() == 0) {
                echo "<img class='icon_etat' src='../web/img/lhorloge.png'/>";
                echo "<p> en attente </p>";
            } else if ($postuler->getEtat() == 1) {
                echo "<p> ✅ <p/>";
                echo "<p> Validé, vous avez été retenu pour ce poste </p>";
            } else {
                echo "<p> ❌ <p/>";
                echo "<p> Refusé, vous n'avez pas été retenu pour ce poste </p>";
            }
            echo "</div>";
        }else{
            echo "<p> Ceci est votre choix définitif </p>";
        }
        echo "</div>";
        echo "</a>";

        if($postuler != null) {
            echo '<div class="page">';
            echo "<a href='controleurFrontal.php?controleur=stage&action=choixDefinitif&idOffre=" . $postuler->getIdOffre() . "'> Choisir cet offre définitivement </a>";
            echo '</div>';
        }
    }
    echo "</div>";
}
