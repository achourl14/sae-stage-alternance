<?php

use App\Modele\Repository\EntrepriseRepository;

echo "<div class='title'> Vos candidatures </div>";
if($offresCandidate == null){
    echo '<div class="msgConfirmation"><p> Vous n\'avez postuler à aucune offre </p></div>';
}else{
    echo "<div class='toutesCandidature'>";
    foreach ($offresCandidate as $offre) {
        echo "<a href='controleurFrontal.php?action=afficherDetail&idOffre=" . $offre->getIdOffre() . "'>";
        echo "<div class='offre_candidature'>";
        $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise());
        echo "<h1>".htmlspecialchars($offre->getNomOffre())."</h1>";
        echo "<h2> Entreprise : " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h2>";
        echo "<h3> id de l'offre : ".$offre->getIdOffre()."</h3>";
        echo "</div>";
        echo "</a>";
    }
    echo "</div>";
}
