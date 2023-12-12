<?php
$numEtu ="";
$nomEtu ="";
$prenomEtu ="";
$numTelEtu ="";
$adresseMailPerso ="";
$adresseMailUniv ="";
$m ="";
$f ="";
$sujet="";
$gratification ="";
$nomEntreprise ="";
$adresseEntreprise ="";
$telephoneEntreprise ="";
$adresseMailEntreprise ="";


if($etudiant != null){

    $isNumEtu = $etudiant->getNumEtudiant();
    $isNomEtu = $etudiant->getNom();
    $isPrenomEtu= $etudiant->getPrenom();
    $isNumTelEtu= $etudiant->getNumTel();
    $isAdresseMailPerso= $etudiant->getMailPerso();
    $isAdresseMailUniv = $etudiant->getEmail();



    $sexeEtu = $etudiant->getSexe();
    if($sexeEtu == "M"){
        $m = "selected";
    }else{
        $f = "selected";
    }
    if(isset($isNumEtu)){
        $numEtu = $isNumEtu;
    }
    if(isset($isNomEtu)){
        $nomEtu = $isNomEtu;
    }
    if(isset($isPrenomEtu)){
        $prenomEtu = $isPrenomEtu;
    }
    if(isset($isNumTelEtu)){
        $numTelEtu = $isNumTelEtu;
    }
    if(isset($isAdresseMailPerso)){
        $adresseMailPerso=$isAdresseMailPerso;
    }
    if(isset($isAdresseMailUniv)){
        $adresseMailUniv=$isAdresseMailUniv;
    }
}
$dateDeDebut = "";
$dateDeFin = "";

if($offre != null){
    $isDateDeDebut = $offre->getDateDebut();
    $isDateDeFin = $offre->getDateFin();
    $isSujet = $offre->getMission();
    $isGratification = $offre->getRemuneration();

    if(isset($isDateDeDebut)){
        $dateDeDebut = $isDateDeDebut;
    }
    if(isset($isDateDeFin)){
        $dateDeFin = $isDateDeFin;
    }
    if (isset($isSujet)){
        $sujet = $isSujet;
    }
    if (isset($isGratification)){
        $gratification = $isGratification;
    }
}

$numSiret = "";
if($entreprise !=null){
    $isNumSiret = $entreprise->getNumSiret();
    $isNomEntreprise = $entreprise->getNomEntreprise();
    $isAdresseEntreprise = $entreprise->getAdresse();
    $isTelephoneEntreprise = $entreprise->getTelephone();
    $isAdresseMailEntreprise = $entreprise->getMail();
    if(isset($numSiret)){
        $numSiret = $isNumSiret;
    }
    if(isset($nomEntreprise)){
        $nomEntreprise = $isNomEntreprise;
    }
    if(isset($adresseEntreprise)){
        $adresseEntreprise = $isAdresseEntreprise;
    }
    if(isset($telephoneEntreprise)){
        $telephoneEntreprise = $isTelephoneEntreprise;
    }
    if(isset($adresseMailEntreprise)){
        $adresseMailEntreprise = $isAdresseMailEntreprise;
    }
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
                        <span class="details">Nom etudiant</span>
                        <input type="text" name="nomEtu"  maxlength="50"  value=<?php echo $nomEtu ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Prénom etudiant</span>
                        <input type="text" name="prenomEtu"  maxlength="50"  value=<?php echo $prenomEtu ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro personel de téléphone de l'étudiant</span>
                        <input type="tel" name="numTelPersoEtu" pattern="[0-9]{10}" maxlength="10" value=<?php echo $numTelEtu ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numero de téléphone de l'étudiant</span>
                        <input type="tel" name="numTelEtu" pattern="[0-9]{10}" maxlength="10" value=<?php echo $numTelEtu ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail personel de l'étudiant</span>
                        <input type="email" name="mailPersoEtu" value=<?php echo $adresseMailPerso ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail universitaire de l'étudiant</span>
                        <input type="email" name="mailUniversitaireEtu"  value=<?php echo $adresseMailUniv ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code UFR</span>
                        <input type="text" placeholder="" name="codeUfr" maxlength="12" />
                    </div>
                    <div class="input-box">
                        <span class="details">Lib UFR</span>
                        <input type="text" placeholder="" name="libUfr" maxlength="100" />
                    </div>
                    <div class="input-box">
                        <span class="details">Code departement</span>
                        <input type="tel" placeholder="" name="codeDepartement" maxlength="10" />
                    </div>
                    <div class="input-box">
                        <span class="details">Code etape</span>
                        <input type="text" placeholder="" name="codeEtape" maxlength="10">
                    </div>
                    <div class="input-box">
                        <span class="details">Lib etape </span>
                        <input type="text" placeholder="" name="libEtape" maxlength="50" />
                    </div>
                    <div class="input-box">
                        <span class="details">Date de début</span>
                        <input type="date" placeholder="" name="dateDeDebut"  value=<?php echo $dateDeDebut ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de fin</span>
                        <input type="date" placeholder="" name="dateDeFin"  value=<?php echo $dateDeFin ?>>
                    </div>
                    <div class="input-box">
                        <label class="details" for="interr"> Interruption </label>
                        <select name="interruption" id="interr">
                            <option value="non">Non</option>
                            <option value="oui">Oui</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Date de début interruption</span>
                        <input type="date" placeholder="" name="dateDebutInterruption" >
                    </div>
                    <div class="input-box">
                        <span class="details">Date de fin interruption</span>
                        <input type="date" placeholder="" name="dateFinInterruption">
                    </div>
                    <div class="input-box">
                        <span class="details">Thématique </span>
                        <input type="text" placeholder="" name="thematique" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Sujet</span>
                        <input type="text" placeholder="" name="sujet" maxlength="10000"  value=<?php echo $sujet ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Fonction Tache</span>
                        <input type="text" placeholder="" name="fonctionTache" maxlength="100" >
                    </div>
                    <div class="input-box">
                        <span class="details">Detail projet</span>
                        <input type="text" placeholder="" name="detailProjet" maxlength="500" >
                    </div>
                    <div class="input-box">
                        <span class="details">Durée</span>
                        <input type="text" placeholder="" name="duree" maxlength="10" >
                    </div>
                    <div class="input-box">
                        <span class="details">Nombres de jours de travail</span>
                        <input type="number" placeholder="" name="nbJourTravail" maxlength="5" />
                    </div>
                    <div class="input-box">
                        <span class="details">Nombre d'heure hebdomadaire</span>
                        <input type="number" placeholder="" name="nbHeureHebdomadaire" maxlength="2" >
                    </div>
                    <div class="input-box">
                        <span class="details">Gratification</span>
                        <input type="number" placeholder="" name="gratification"  value=<?php echo $gratification ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Unité de la gratification</span>
                        <input type="text" placeholder="" name="uniteGratification" maxlength="100" >
                    </div>
                    <div class="input-box">
                        <span class="details">unité durée de la gratification</span>
                        <input type="text" placeholder="" name="uniteDureeGratification" maxlength="10" >
                    </div>
                    <div class="input-box">
                        <span class="details">Convention Valide</span>
                        <input type="text" placeholder="" name="conventionValide" maxlength="3" >
                    </div>
                    <div class="input-box">
                        <span class="details">Nom de l'enseignant référent</span>
                        <input type="text" placeholder="" name="nomEnseignantReferent" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Prenom de l'enseignant référent</span>
                        <input type="text" placeholder="" name="prenomEnseignantReferent" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail de l'enseignant référent</span>
                        <input type="text" placeholder="" name="mailEnseignantReferent" maxlength="100" >
                    </div>
                    <div class="input-box">
                        <span class="details">Nom du signataire</span>
                        <input type="text" placeholder="" name="nomSignataire" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Prenom du signataire</span>
                        <input type="text" placeholder="" name="prenomSignataire" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail du signataire</span>
                        <input type="text" placeholder="" name="mailSignataire" maxlength="100" >
                    </div>
                    <div class="input-box">
                        <span class="details">Fonction du signataire</span>
                        <input type="text" placeholder="" name="fonctionSignataire" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Année universitaire</span>
                        <input type="number" min="2000" max="2099" step="1" name="anneeUniversitaire" >
                    </div>
                    <div class="input-box">
                        <span class="details">Type de convention</span>
                        <input type="text" placeholder="" name="typeDeConvention" maxlength="50"
                               value="Formation Initiale - Stage Obligatoire" >
                    </div>
                    <div class="input-box">
                        <span class="details">Commentaire du stage</span>
                        <input type="text" placeholder="" name="commentaireStage" maxlength="200" >
                    </div>
                    <div class="input-box">
                        <span class="details">Commentaire durée de Travail</span>
                        <input type="text" placeholder="" name="commentaireDureeTravail" maxlength="200" >
                    </div>
                    <div class="input-box">
                        <span class="details">Code ELP</span>
                        <input type="text" placeholder="" name="codeELP" maxlength="11" />
                    </div>
                    <div class="input-box">
                        <span class="details">Element pedagogique</span>
                        <input type="text" placeholder="" name="elementPedagogique" maxlength="100" />
                    </div>
                    <div class="input-box">
                        <label class="details" for="sex"> Sexe de l'étudiant </label>
                        <select name="codeSexeEtu" id="sex" >
                            <option value="M" <?php echo $m ?>>Masculin</option>
                            <option value="F" <?php echo $f ?>>Féminin</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Avantage nature</span>
                        <input type="text" placeholder="" name="avantageNature" maxlength="50" />
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse de l'étudiant</span>
                        <input type="text" placeholder="" name="adresseEtu" maxlength="100" />
                    </div>
                    <div class="input-box">
                        <span class="details">Code postal de l'étudiant</span>
                        <input type="number" placeholder="" name="codePostalEtu" maxlength="11" >
                    </div>
                    <div class="input-box">
                        <span class="details">Pays de l'étudiant</span>
                        <input type="text" placeholder="" name="paysEtu" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Ville de l'étudiant</span>
                        <input type="text" placeholder="" name="villeEtu" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <label class="details" for="convVal"> Convention validé pédagogiquement </label>
                        <select name="conventionValidePedagogique" id="convVal" >
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label class="details" for="avenant"> Avenant </label>
                        <select name="avenant" id="avenant" >
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Détail de l'avenant</span>
                        <input type="text" placeholder="" name="detailAvenant" maxlength="100" >
                    </div>
                    <div class="input-box">
                        <span class="details">Date de création de la convention</span>
                        <input type="date" placeholder="" name="dateCreationConvention" >
                    </div>
                    <div class="input-box">
                        <span class="details">Date de modification de la convention</span>
                        <input type="date" placeholder="" name="dateModificationConvention" >
                    </div>
                    <div class="input-box">
                        <span class="details">Origine stage</span>
                        <input type="text" placeholder="" name="origineStage" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Nom de l'établissement</span>
                        <input type="text" placeholder="" name="nomEtablissement" maxlength="50"  value=<?php echo $nomEntreprise ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de Siret </span>
                        <input type="text" placeholder="" name="siret" maxlength="14" required  value=<?php echo $numSiret ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse de résidence</span>
                        <input type="text" placeholder="" name="adresseResidence" maxlength="50"  value=<?php echo $adresseEntreprise ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse voie</span>
                        <input type="text" placeholder="" name="adresseVoie" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse de libellé Cedex</span>
                        <input type="text" placeholder="" name="adresseLibCedex" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Code postal</span>
                        <input type="Number" placeholder="" name="codePostal" maxlength="11" >
                    </div>
                    <div class="input-box">
                        <span class="details">Commune de l'établissement d'acceuil</span>
                        <input type="text" placeholder="" name="communeEtabAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Pays de l'établissement</span>
                        <input type="text" placeholder="" name="paysEtablissement" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Statut juridique</span>
                        <input type="text" placeholder="" name="statutJuridique" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Type de la structure</span>
                        <input type="text" placeholder="" name="typeStructure" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Effectif</span>
                        <input type="text" placeholder="" name="effectif" maxlength="20" >
                    </div>
                    <div class="input-box">
                        <span class="details">Code NAF</span>
                        <input type="text" placeholder="" name="codeNAF" maxlength="20" >
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de téléphone de l'établissement</span>
                        <input type="text" placeholder="" name="telEtablissement" maxlength="10"  value=<?php echo $telephoneEntreprise?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Fax</span>
                        <input type="text" placeholder="" name="fax" maxlength="20" >
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail de l'établissement</span>
                        <input type="text" placeholder="" name="mailEtablissement" maxlength="50"  value=<?php echo $adresseMailEntreprise?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Site web</span>
                        <input type="text" placeholder="" name="siteWeb" maxlength="200" >
                    </div>
                    <div class="input-box">
                        <span class="details">Nom du service d'acceuil</span>
                        <input type="text" placeholder="" name="nomServiceAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Résidence du service d'acceuil</span>
                        <input type="text" placeholder="" name="residenceServiceAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Voie du service d'acceuil</span>
                        <input type="text" placeholder="" name="voieServiceAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Cedex du service d'acceuil</span>
                        <input type="text" placeholder="" name="cedexServiceAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Code postal du service d'acceuil</span>
                        <input type="number" placeholder="" name="codePostalServiceAcceuil" maxlength="11" >
                    </div>
                    <div class="input-box">
                        <span class="details">Commune du service d'acceuil</span>
                        <input type="text" placeholder="" name="communeServiceAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Pays du service d'acceuil</span>
                        <input type="text" placeholder="" name="paysServiceAcceuil" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Nom du tuteur professionnel</span>
                        <input type="text" placeholder="" name="nomTuteurProfessionnel" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Prenom du tuteur professionnel</span>
                        <input type="text" placeholder="" name="prenomTuteurProfessionnel" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail du tuteur professionnel</span>
                        <input type="text" placeholder="" name="mailTuteurProfessionnel" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de téléphone du tuteur professionnel</span>
                        <input type="text" placeholder="" name="telTuteurProfessionnel" maxlength="50" >
                    </div>
                    <div class="input-box">
                        <span class="details">Fonction du tuteur professionnel</span>
                        <input type="text" placeholder="" name="fonctionTuteurProfessionnel" maxlength="50" >
                    </div>

                </div>
                <div class="button">
                    <input type="submit" value="Créer ma convention">
                </div>

            </form>
        </div>
    </div>
</div>


