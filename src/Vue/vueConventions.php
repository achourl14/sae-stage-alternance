<div class="contient">
<div class="container">
    <div class="title">Convention</div>
    <div class="content">
        <form method="post" name="inscription" action="controleurFrontal.php?action=creerEntreprise">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Numero Etudiant</span>
                    <input type="text" name="numEtudiant" required/>
                </div>
                <div class="input-box">
                    <span class="details">code UFR</span>
                    <input type="text" placeholder="" name="codeUfr" maxlength="12" required>
                </div>
                <div class="input-box">
                    <span class="details">lib UFR</span>
                    <input type="text" placeholder="" name="libUfr" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">code Departement</span>
                    <input type="tel" placeholder="" name="codeDepartement"  maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="details">code Etape</span>
                    <input type="email" placeholder="" name="codeEtape"  maxlength="10">
                </div>
                <div class="input-box">
                    <span class="details">lib Etape </span>
                    <input type="text" placeholder="" name="libEtape" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">date de début</span>
                    <input type="date" placeholder="" name="dateDeDebut" required>
                </div>
                <div class="input-box">
                    <span class="details">date de fin</span>
                    <input type="date" placeholder="" name="dateDeFin"  required>
                </div>
                <div class="input-box">
                    <label class="details" for="interr"> interruption </label>
                    <select name="interruption" id="interr" required>
                        <option value="non">Non</option>
                        <option value="oui"> oui </option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">date de début Interruption</span>
                    <input type="date" placeholder="" name="dateDeDebut" required>
                </div>
                <div class="input-box">
                    <span class="details">date de fin interruption</span>
                    <input type="date" placeholder="" name="dateDeFin"  required>
                </div>
                <div class="input-box">
                    <span class="details">thématique </span>
                    <input type="text" placeholder="" name="thematique" maxlength="50" required>
                </div>
                <div class="input-box">
                    <span class="details">Sujet</span>
                    <input type="text" placeholder="" name="sujet" maxlength="500" required>
                </div>
                <div class="input-box">
                    <span class="details">Sujet</span>
                    <input type="text" placeholder="" name="sujet" maxlength="500" required>
                </div>
                <div class="input-box">
                    <span class="details">fonction Tache</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">detail projet</span>
                    <input type="text" placeholder="" name="detailProjet" maxlength="500" required>
                </div>
                <div class="input-box">
                    <span class="details">durée</span>
                    <input type="text" placeholder="" name="duree" maxlength="10" required>
                </div>
                <div class="input-box">
                    <span class="details">Nombres jours de travail</span>
                    <input type="number" placeholder="" name="nbJourTravail" maxlength="5" required>
                </div>
                <div class="input-box">
                    <span class="details">Nombre d'heure hebdomadaire</span>
                    <input type="number" placeholder="" name="fonctionTache" maxlength="2" required>
                </div>
                <div class="input-box">
                    <span class="details">gratification</span>
                    <input type="number" placeholder="" name="gratification" required>
                </div>
                <div class="input-box">
                    <span class="details">unité de la gratification</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
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
                    <span class="details">ID de l'enseignant Référent</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">ID du signataire</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Année Universitaire</span>
                    <input type="number" min="1900" max="2099" step="1" name="anneeUniversitaire" required>
                </div>
                <div class="input-box">
                    <span class="details">Type de Convention</span>
                    <input type="text" placeholder="" name="typeDeConvention" maxlength="50" value="Formation Initiale - Stage Obligatoire" required>
                </div>
                <div class="input-box">
                    <span class="details">commentaire du Stage</span>
                    <input type="text" placeholder="" name="commentaireStage" maxlength="200" required>
                </div>
                <div class="input-box">
                    <span class="details">commentaire durée de Travail</span>
                    <input type="text" placeholder="" name="commentaireDureeTravail" maxlength="200" required>
                </div>
                <div class="input-box">
                    <span class="details">Code ELP</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">Element Pedagogique</span>
                    <input type="text" placeholder="" name="elementPedagogique" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">ID du signataire</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>
                <div class="input-box">
                    <span class="details">date de Modification de la Convention</span>
                    <input type="text" placeholder="" name="fonctionTache" maxlength="100" required>
                </div>


            </div>
            <div class="button">
                <input type="submit" value="S'inscrire">
            </div>
        </form>
    </div>
</div>
</div>


