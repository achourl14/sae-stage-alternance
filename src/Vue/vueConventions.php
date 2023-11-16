<div class="contient">
<div class="container">
    <div class="title">Convention</div>
    <div class="content">
        <form method="post" name="inscription" action="controleurFrontal.php?action=creerEntreprise">
            <div class="user-details">


                <div class="input-box">
                    <span class="details">Numero etudiant</span>
                    <input type="text" name="numEtudiant" required/>
                </div>
                <div class="input-box">
                    <span class="details">Nom etudiant</span>
                    <input type="text" name="nomEtu" required/>
                </div>
                <div class="input-box">
                    <span class="details">Prénom etudiant</span>
                    <input type="text" name="prenomEtu" required/>
                </div>
                <div class="input-box">
                    <span class="details">Numéro personel de téléphone de l'etudiant</span>
                    <input type="text" name="numTelPersoEtu" required/>
                </div>
                <div class="input-box">
                    <span class="details">Numero de téléphone de l'étudiant</span>
                    <input type="text" name="numTelEtu" required/>
                </div>
                <div class="input-box">
                    <span class="details">Adresse mail personel de l'étudiant</span>
                    <input type="text" name="mailPersoEtu" required/>
                </div>
                <div class="input-box">
                    <span class="details">Adresse mail universitaire de l'étudiant</span>
                    <input type="text" name="mailUniversitaireEtu" required/>
                </div>
                <div class="input-box">
                    <span class="details">Code UFR</span>
                    <input type="text" placeholder="" name="codeUfr" maxlength="12" required>
                </div>
                <div class="input-box">
                    <span class="details">Lib UFR</span>
                    <input type="text" placeholder="" name="libUfr" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Code departement</span>
                    <input type="tel" placeholder="" name="codeDepartement"  maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="details">Code etape</span>
                    <input type="email" placeholder="" name="codeEtape"  maxlength="10">
                </div>
                <div class="input-box">
                    <span class="details">Lib etape </span>
                    <input type="text" placeholder="" name="libEtape" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Date de début</span>
                    <input type="date" placeholder="" name="dateDeDebut" required>
                </div>
                <div class="input-box">
                    <span class="details">Date de fin</span>
                    <input type="date" placeholder="" name="dateDeFin"  required>
                </div>
                <div class="input-box">
                    <label class="details" for="interr"> Interruption </label>
                    <select name="interruption" id="interr" required>
                        <option value="non">Non</option>
                        <option value="oui">Oui </option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Date de début interruption</span>
                    <input type="date" placeholder="" name="dateDebutInterruption" required>
                </div>
                <div class="input-box">
                    <span class="details">Date de fin interruption</span>
                    <input type="date" placeholder="" name="dateFinInterruption"  required>
                </div>
                <div class="input-box">
                    <span class="details">Thématique </span>
                    <input type="text" placeholder="" name="thematique" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Sujet</span>
                    <input type="text" placeholder="" name="sujet" maxlength="500" required>
                </div>
                <div class="input-box">
                    <span class="details">Fonction Tache</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Detail projet</span>
                    <input type="text" placeholder="" name="detailProjet" maxlength="500" required>
                </div>
                <div class="input-box">
                    <span class="details">Durée</span>
                    <input type="text" placeholder="" name="duree" maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="details">Nombres de jours de travail</span>
                    <input type="number" placeholder="" name="nbJourTravail" maxlength="5" required>
                </div>
                <div class="input-box">
                    <span class="details">Nombre d'heure hebdomadaire</span>
                    <input type="number" placeholder="" name="nbHeureHebdomadaire" maxlength="2" required>
                </div>
                <div class="input-box">
                    <span class="details">Gratification</span>
                    <input type="number" placeholder="" name="gratification" required>
                </div>
                <div class="input-box">
                    <span class="details">Unité de la gratification</span>
                    <input type="text" placeholder="" name="uniteGratification" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">unité durée de la gratification</span>
                    <input type="text" placeholder="" name="uniteDureeGratification" maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="details">Convention Valide</span>
                    <input type="text" placeholder="" name="conventionValide" maxlength="3" required>
                </div>
                <div class="input-box">
                    <span class="details">Nom de l'enseignant référent</span>
                    <input type="text" placeholder="" name="nomEnseignantReferent" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Prenom de l'enseignant référent</span>
                    <input type="text" placeholder="" name="prenomEnseignantReferent" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Adresse mail de l'enseignant référent</span>
                    <input type="text" placeholder="" name="mailEnseignantReferent" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Nom du signataire</span>
                    <input type="text" placeholder="" name="nomSignataire" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Prenom du signataire</span>
                    <input type="text" placeholder="" name="prenomSignataire" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Adresse mail du signataire</span>
                    <input type="text" placeholder="" name="mailSignataire" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Fonction du signataire</span>
                    <input type="text" placeholder="" name="fonctionSignataire" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Année universitaire</span>
                    <input type="number" min="2000" max="2099" step="1" name="anneeUniversitaire" required>
                </div>
                <div class="input-box">
                    <span class="details">Type de convention</span>
                    <input type="text" placeholder="" name="typeDeConvention" maxlength="50" value="Formation Initiale - Stage Obligatoire" required>
                </div>
                <div class="input-box">
                    <span class="details">Commentaire du stage</span>
                    <input type="text" placeholder="" name="commentaireStage" maxlength="200" required>
                </div>
                <div class="input-box">
                    <span class="details">Commentaire durée de Travail</span>
                    <input type="text" placeholder="" name="commentaireDureeTravail" maxlength="200" required>
                </div>
                <div class="input-box">
                    <span class="details">Code ELP</span>
                    <input type="text" placeholder="" name="codeELP" maxlength="11" required>
                </div>
                <div class="input-box">
                    <span class="details">Element pedagogique</span>
                    <input type="text" placeholder="" name="elementPedagogique" maxlength="100" required>
                </div>
                <div class="input-box">
                    <label class="details" for="sex"> Sexe de l'étudiant </label>
                    <select name="codeSexeEtu" id="sex" required>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Avantage nature</span>
                    <input type="text" placeholder="" name="avantageNature" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Adresse de l'étudiant</span>
                    <input type="text" placeholder="" name="adresseEtu" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">46 dans la bdd</span>
                    <input type="text" placeholder="" name="elementPedagogique" maxlength="100" required>
                </div>



            </div>
            <div class="button">
                <input type="submit" value="S'inscrire">
            </div>
        </form>
    </div>
</div>
</div>


