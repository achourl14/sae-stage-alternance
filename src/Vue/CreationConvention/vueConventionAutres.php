<?php

$avenantNon ="";
$avenantOui ="";

if($convention->getAvenant() == "non"){
    $avenantNon = "selected";
}else{
    $avenantOui = "selected";
}
?>
<div class="contient">
    <div class="container">
        <div class="content">
            <form method="post" class="formulaire"
                  action="controleurFrontal.php?controleur=convention&action=MiseAJourConventionAutres">
                <div class="title">Convention</div>

                <div class='page'>
                    <div><p>Etudiant</p></div>
                    <div><p>Entreprise</p></div>
                    <div><p>Details du stage</p></div>
                    <div><p class="activeP">Autres</p></div>
                </div>
                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Numero Convention</span>
                        <input type="text" name="numConvention" required readonly
                               value=<?php echo $convention->getNumConvention() ?>>
                    </div>


                    <div class="input-box">
                        <label class="details" for="avenant"> Avenant </label>
                        <select name="avenant" id="avenant" >
                            <option value="oui"<?php echo $avenantOui ?>>Oui</option>
                            <option value="non"<?php echo $avenantNon ?>>Non</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Détail de l'avenant</span>
                        <input type="text" placeholder="" name="detailAvenant" maxlength="100" value=<?php echo $convention->getDetailAvenant() ?>>
                    </div>

                    <div class="input-box">
                        <span class="details">Nom de l'enseignent référent</span>
                        <input type="text" placeholder="" name="nomEnseignantReferent" maxlength="50" value=<?php echo $convention->getNomEnseignantReferent() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Prenom de l'enseignent référent</span>
                        <input type="text" placeholder="" name="prenomEnseignantReferent" maxlength="50" value=<?php echo $convention->getPrenomEnseignentReferent() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail de l'enseignent référent</span>
                        <input type="text" placeholder="" name="mailEnseignantReferent" maxlength="100" value=<?php echo $convention->getMailEnseignentReferent() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Nom du signataire</span>
                        <input type="text" placeholder="" name="nomSignataire" maxlength="50" value=<?php echo $convention->getNomSignataire() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Prenom du signataire</span>
                        <input type="text" placeholder="" name="prenomSignataire" maxlength="50" value=<?php echo $convention->getPrenomSignataire() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail du signataire</span>
                        <input type="text" placeholder="" name="mailSignataire" maxlength="100" value=<?php echo $convention->getMailSignataire() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Fonction du signataire</span>
                        <input type="text" placeholder="" name="fonctionSignataire" maxlength="50" value=<?php echo $convention->getFonctionSignataire() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code ELP</span>
                        <input type="text" placeholder="" name="codeELP" maxlength="11" value=<?php echo $convention->getCodeELP() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Element pedagogique</span>
                        <input type="text" placeholder="" name="elementPedagogique" maxlength="100" value=<?php echo $convention->getElementPedagogique() ?>>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Terminez">
                </div>
            </form>
        </div>
    </div>
</div>
