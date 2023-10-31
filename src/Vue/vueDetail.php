<?php
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\OffreRepository;

if(isset($_GET["idOffre"])){
    echo '<div class="offre_detail">';
    $offre = (new OffreRepository())->recupererParClePrimaire($_GET["idOffre"]);
    $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($offre->getIdEntreprise());
    $type = "Stage et Alternance";
    if($offre->getType() == "S"){
        $type = "Stage";
    }else if($offre->getType() == "A"){
        $type = "Alternance";
    }
    echo "<h1>".htmlspecialchars($offre->getNomOffre())."</h1>";
    echo "<h2> Entreprise : " . htmlspecialchars($entreprise->getNomEntreprise()) . "</h2>";
    echo "<h2> Adresse : ". $entreprise->getAdresse() ."</h2>";

    if(\App\Lib\ConnexionUtilisateur::estEtudiant()){
        echo '<div class="boutonsGeneral">';
        echo '<a  href="#"> Postuler sur cette offre </a>';
        echo '</div>';
    }

    echo "<hr/>";
    echo "<h1> Detail du poste : </h1>";

    echo "<h3> &#128182; Rémunération </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'> Environ ".$offre->getRemuneration() ." € par mois</p>";
    echo "</div>";

    echo "<h3> &#128188; Type de poste </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>".$type ."</p>";
    echo "</div>";

    echo "<h3> &#128198; Dates </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'> Date de début : ".$offre->getDateDebut() ."</p>";
    echo "<p class='case'> Date de fin : ".$offre->getDateFin() ."</p>";
    echo "</div>";
    $annee ="";
    if($offre->getButAnnee() == 0){ $annee = "BUT 2 ou BUT 3"; }else {$annee = "BUT ". $offre->getButAnnee();}
     echo "<h3> 🎯 Cible d'étudiant </h3>";
    echo "<div class='supcase'>";
    echo "<p class='case'>". $annee  ."</p>";
    echo "<p class='case'> Parcours : ".$offre->getParcours() ."</p>";
    echo "</div>";


    echo "<h3> Mission </h3>";
    echo("<p>" . htmlspecialchars($offre->getMission()) . "</p> ");

    echo'</div>';
}else{
    echo '<div class="msgConfirmation"><p> ⚠️ Cette offre est introuvable ⚠️ </p></div>';
}


