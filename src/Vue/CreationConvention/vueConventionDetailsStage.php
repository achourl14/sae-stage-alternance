<?php

$interruptionOui ="";
$interruptionNon ="";


if($convention->getInterruption() == "non"){
    $interruptionNon = "selected";
}else{
    $interruptionOui = "selected";
}
?>
<div class="contient">
    <div class="container">
        <div class="content">
            <form method="post" class="formulaire"
                  action="controleurFrontal.php?controleur=convention&action=MiseAJourConventionDetailStage">
                <div class="title">Convention</div>

                <div class='page'>
                    <div><p>Etudiant</p></div>
                    <div><p>Entreprise</p></div>
                    <div><p class="activeP">Details du stage</p></div>
                    <div><p>Autres</p></div>
                </div>


                <div class="user-details">


                    <div class="input-box">
                        <span class="details">Date de début</span>
                        <input type="date" placeholder="" name="dateDeDebut"  value=<?php echo $convention->getDateDebut()?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de fin</span>
                        <input type="date" placeholder="" name="dateDeFin"  value=<?php echo $convention->getDateFin() ?>>
                    </div>
                    <div class="input-box">
                        <label class="details" for="interr"> Interruption </label>
                        <select name="interruption" id="interr" >
                            <option value="non" <?php echo $interruptionNon ?>>Non</option>
                            <option value="oui" <?php echo $interruptionOui ?>>Oui</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de début interruption</span>
                        <input type="date" placeholder="" name="dateDebutInterruption" value=<?php echo $convention->getDateDebutInterruption() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de fin interruption</span>
                        <input type="date" placeholder="" name="dateFinInterruption" value=<?php echo $convention->getdateFinInterruption() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Thématique </span>
                        <input type="text" placeholder="" name="thematique" maxlength="50" value=<?php echo $convention->getThematique() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Sujet</span>
                        <input type="text" placeholder="" name="sujet" maxlength="10000" value=<?php echo $convention->getSujet() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Fonction Tache</span>
                        <input type="text" placeholder="" name="fonctionTache" maxlength="100" value=<?php echo $convention->getFonctionTache() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Detail projet</span>
                        <input type="text" placeholder="" name="detailProjet" maxlength="500" value=<?php echo $convention->getDetailProjet() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Durée</span>
                        <input type="text" placeholder="" name="duree" maxlength="10" value=<?php echo $convention->getDuree() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Nombres de jours de travail</span>
                        <input type="number" placeholder="" name="nbJourTravail" maxlength="5" value=<?php echo $convention->getNbJourTravail() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Nombre d'heure hebdomadaire</span>
                        <input type="number" placeholder="" name="nbHeureHebdomadaire" maxlength="2" value=<?php echo $convention->getNbHeureHebdomadairer() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Gratification</span>
                        <input type="number" placeholder="" name="gratification" value=<?php echo $convention->getGratification() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Unité de la gratification</span>
                        <input type="text" placeholder="" name="uniteGratification" maxlength="100" value=<?php echo $convention->getUniteGratification() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">unité durée de la gratification</span>
                        <input type="text" placeholder="" name="uniteDureeGratification" maxlength="10" value=<?php echo $convention->getUniteDureGratification() ?>>
                    </div>

                    <div class="input-box">
                        <span class="details">Année universitaire</span>
                        <input type="number" min="2000" max="2099" step="1" name="anneeUniversitaire" value=<?php echo $convention->getAnneeUniversitaire() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Type de convention</span>
                        <input type="text" placeholder="" name="typeDeConvention" maxlength="50" readonly
                               value="Formation Initiale - Stage Obligatoire" >
                    </div>
                    <div class="input-box">
                        <span class="details">Commentaire du stage</span>
                        <input type="text" placeholder="" name="commentaireStage" maxlength="200" value=<?php echo $convention->getCommentaireStage() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Commentaire durée de Travail</span>
                        <input type="text" placeholder="" name="commentaireDureeTravail" maxlength="200" value=<?php echo $convention->getCommentaireDureeTravail() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Avantage nature</span>
                        <input type="text" placeholder="" name="avantageNature" maxlength="50" value=<?php echo $convention->getAvantageNature() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de création de la convention</span>
                        <input type="date" placeholder="" name="dateCreationConvention" value=<?php echo $convention->getDateCreationConvention() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de modification de la convention</span>
                        <input type="date" placeholder="" name="dateModificationConvention" value=<?php echo $convention->getDateModificationConvention() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Origine stage</span>
                        <input type="text" placeholder="" name="origineStage" maxlength="50" value=<?php echo $convention->getOrigineStage() ?>>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Suivant">
                </div>
            </form>
        </div>
    </div>
</div>
