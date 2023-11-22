<?php

use App\Modele\Repository\EtudiantRepository;

echo "<div class='title'> Les candidatures pour votre offre </div>";

if($postulers == null){
    echo '<div class="msgConfirmation"><p> Aucun étudiant a postuler pour cette offre </p></div>';
}else{
    echo "<div class='toutesCandidature'>";
    foreach ($postulers as $postuler) {
        echo "<div class='offre_candidature'>";
        echo "<div>";
        $etudiant = (new EtudiantRepository())->recupererParClePrimaire($postuler->getCodeINE());
        echo "<h1>".htmlspecialchars($etudiant->getPrenom())." ".htmlspecialchars($etudiant->getNom())."</h1>";
        echo "<h2> Numéro INE : " . htmlspecialchars($etudiant->getCodeINE()) . "</h2>";
        echo "<h2> Numéro Etudiant : ". htmlspecialchars($etudiant->getNumEtudiant()) ."</h2>";
        echo '</div>';

        echo "<div class='etat'>";
        if($postuler->getEtat() == 0){
            echo "<img class='icon_etat' src='../web/img/lhorloge.png'/>";
            echo "<p> en attente </p>";
        }else if($postuler->getEtat() == 1){
            echo "<p> ✅ <p/>";
            echo "<p>,  Validé, vous avez été retenu pour ce poste </p>";
        }else{
            echo "<p> ❌ <p/>";
            echo "<p>, Refusé, vous n'avez pas été retenu pour ce poste </p>";
        }
        echo "</div>";
        echo "<a href='controleurFrontal.php?controleur=entreprise&action=accepterCandidature&idOffre=".$postuler->getIdOffre()."&codeINE=".$postuler->getCodeINE()."'> Accepter </a>";
        echo "<a href='controleurFrontal.php?controleur=entreprise&action=refuserCandidature&idOffre=".$postuler->getIdOffre()."&codeINE=".$postuler->getCodeINE()."'> Refuser </a>";
        echo "</div>";

    }
    echo "</div>";
}
