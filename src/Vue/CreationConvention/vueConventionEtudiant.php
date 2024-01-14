<?php
$m = "";
$f = "";
$interruptionOui = "";
$interruptionNon = "";
$avenantNon = "";
$avenantOui = "";

if ($convention->getCodeSexeEtu() == "M") {
    $m = "selected";
} else {
    $f = "selected";
}

if ($convention->getInterruption() == "non") {
    $interruptionNon = "selected";
} else {
    $interruptionOui = "selected";
}

if ($convention->getAvenant() == "non") {
    $avenantNon = "selected";
} else {
    $avenantOui = "selected";
}
?>
<div class="contient">
    <div class="container">
        <div class="content">
            <form method="post" class="formulaire"
                  action="controleurFrontal.php?controleur=convention&action=MiseAJourConventionEtudiant">
                <div class="title">Convention</div>

                <div class='page'>
                    <div><h4 class="activeP">Etudiant</h4></div>
                    <div><h4>Entreprise</h4></div>
                    <div><h4>Details du stage</h4></div>
                    <div><h4>Autres</h4></div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Numero Convention</span>
                        <input type="text" name="numConvention" required readonly
                               value=<?php echo $convention->getNumConvention() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numero etudiant</span>
                        <input type="text" name="numEtudiant" pattern="[0-9]{8}" maxlength="8" required readonly
                               value=<?php echo $convention->getNumEtudiant() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Nom etudiant</span>
                        <input type="text" name="nomEtu" maxlength="50" value=<?php echo $convention->getNomEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Prénom etudiant</span>
                        <input type="text" name="prenomEtu" maxlength="50"
                               value=<?php echo $convention->getPrenomEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro personel de téléphone de l'etudiant</span>
                        <input type="tel" name="numTelPersoEtu" pattern="[0-9]{10}" maxlength="10"
                               value=<?php echo $convention->getNumTelPersoEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numero de téléphone de l'étudiant</span>
                        <input type="tel" name="numTelEtu" pattern="[0-9]{10}" maxlength="10"
                               value=<?php echo $convention->getNumTelEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail personel de l'étudiant</span>
                        <input type="email" name="mailPersoEtu" value=<?php echo $convention->getMailPersoEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail universitaire de l'étudiant</span>
                        <input type="email" name="mailUniversitaireEtu"
                               value=<?php echo $convention->getMailUniversitaireEtu() ?>>
                    </div>
                    <div class="input-box">
                        <label class="details" for="sex"> Sexe de l'étudiant </label>
                        <select name="codeSexeEtu" id="sex">
                            <option value="M" <?php echo $m ?>>Masculin</option>
                            <option value="F" <?php echo $f ?>>Féminin</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse de l'étudiant</span>
                        <input type="text" placeholder="" name="adresseEtu" maxlength="100"
                               value=<?php echo $convention->getAdresseEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code postal de l'étudiant</span>
                        <input type="number" placeholder="" name="codePostalEtu" maxlength="11"
                               value=<?php echo $convention->getCodePostalEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Pays de l'étudiant</span>
                        <input type="text" placeholder="" name="paysEtu" maxlength="50"
                               value=<?php echo $convention->getPaysEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Ville de l'étudiant</span>
                        <input type="text" placeholder="" name="villeEtu" maxlength="50"
                               value=<?php echo $convention->getVilleEtu() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code UFR</span>
                        <input type="text" placeholder="" name="codeUfr" maxlength="12"
                               value=<?php echo $convention->getCodeUfr() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Lib UFR</span>
                        <input type="text" placeholder="" name="libUfr" maxlength="100"
                               value=<?php echo $convention->getLibUfr() ?>>
                    </div>

                    <div class="input-box">
                        <span class="details">Code departement</span>
                        <input type="tel" placeholder="" name="codeDepartement" maxlength="10"
                               value=<?php echo $convention->getCodeDepartement() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code etape</span>
                        <input type="text" placeholder="" name="codeEtape" maxlength="10"
                               value=<?php echo $convention->getCodeEtape() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Lib etape </span>
                        <input type="text" placeholder="" name="libEtape" maxlength="50"
                               value=<?php echo $convention->getLibEtape() ?>>
                    </div>


                </div>
                <div class="button">
                    <input type="submit" value="Suivant">
                </div>

            </form>
        </div>
    </div>
</div>