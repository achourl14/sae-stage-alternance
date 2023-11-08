<?php

use App\Modele\Repository\EtudiantRepository;

echo "<div class='title'> Les candidatures pour votre offre </div>";

if($postulers == null){
    echo '<div class="msgConfirmation"><p> Aucun étudiant a postuler pour cette offre </p></div>';
}else{
    echo "<div class='toutesCandidature'>";
    foreach ($postulers as $postuler) {
        echo "<div class='offre_candidature'>";
        $etudiant = (new EtudiantRepository())->recupererParClePrimaire($postuler->getCodeINE());
        echo "<h1>".htmlspecialchars($etudiant->getPrenom())." ".htmlspecialchars($etudiant->getNom())."</h1>";
        echo "<h2> Numéro INE : " . htmlspecialchars($etudiant->getCodeINE()) . "</h2>";
        echo "<h2> Numéro Etudiant : ". htmlspecialchars($etudiant->getNumEtudiant()) ."</h2>";
        echo "</div>";
    }
    echo "</div>";
}
