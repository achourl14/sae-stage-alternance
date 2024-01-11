<?php
$numEtu ="";
if($etudiant != null) {

    $isNumEtu = $etudiant->getNumEtudiant();

    if(isset($isNumEtu)){
        $numEtu = $isNumEtu;
    }
}
$numSiret = "";
if($entreprise !=null) {
    $isNumSiret = $entreprise->getNumSiret();

    if(isset($isNumSiret)){
        $numSiret = $isNumSiret;
    }
}
$idOffre = "";
if($offre != null){
    $idOffre = $offre->getIdOffre();
}


?>

<div class="contient">
    <div class="container">
        <div class="content">
            <form method="post" class="formulaire" action="controleurFrontal.php?controleur=convention&action=creerConvention">
                <div class="title">Convention</div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Numero etudiant</span>
                        <input type="text" name="numEtudiant" pattern="[0-9]{8}" maxlength="8" required value=<?php echo $numEtu ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de Siret </span>
                        <input type="text" placeholder="" name="siret" maxlength="14" required  value=<?php echo $numSiret ?>>
                    </div>
                    <div class="input-box">
                        <input type="text" name="idOffre" hidden="hidden" value=<?php echo $idOffre  ?>>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Créer votre convention">
                </div>

            </form>
        </div>
    </div>
</div>
