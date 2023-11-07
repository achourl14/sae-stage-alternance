<div class="contient">
    <div class="container">

        <div class="content">
            <form method="post" action="controleurFrontal.php?action=creerOffre">
                <div class="title"> Création d'une offre par une entreprise</div>

                <div class="user-details">
                    <div class="input-box">
                        <label for="Entreprise" class="details">Numéro Siret de l'entreprise </label>
                        <input type="text" value=<?php use App\Lib\ConnexionUtilisateur;

                        echo ConnexionUtilisateur::getLoginUtilisateurConnecte() ?> name="idEntreprise" id="Entreprise"
                               required readonly/>
                    </div>

                    <div class="input-box">
                        <label class="details" for="idnom">Nom de l'offre </label>
                        <input maxlength="50" type="text" placeholder="" name="nomOffre" id="idnom" required/>
                    </div>

                    <div class="input-box">
                        <label class="details" for="dateD"> Date de début </label>
                        <input maxlength="50" type="date" placeholder="" name="dateDebut" id="dateD" required/>
                    </div>

                    <div class="input-box">
                        <label class="details" for="dateF"> Date de fin </label>
                        <input maxlength="50" type="date" placeholder="" name="dateFin" id="dateF" required/>
                    </div>

                    <div class="input-box">
                        <label class="details" for="rem"> Remunération par mois </label>
                        <input maxlength="50" type="number" placeholder="" name="remuneration" id="remuneration"
                               required/>
                    </div>

                    <div class="input-box">
                        <label class="details" for="annee"> Offre pour année de BUT </label>
                    <select name="but_annee" id="annee">
                        <option value="0">Toutes les années</option>
                        <option value="2">BUT 2 (2ème année)</option>
                        <option value="3">BUT 3 (3ème année)</option>
                    </select>
                    </div>

                    <div class="input-box">
                        <label class="details" for="parcoursCible"> Parcours cible </label>
                        <select name="parcours" id="parcoursCible">
                            <option value="Tout">Tous les parcours</option>
                            <option value="RACDV"> RACDV </option>
                            <option value="IAMSI"> IAMSI </option>
                            <option value="DACS"> DACS </option>
                        </select>
                    </div>

                    <div class="input-box">
                        <label class="details" for="choixSA"> Choix Stage / Alternance </label>
                        <select name="type" id="choixSA">
                            <option value="SA">Stage ou Alternance</option>
                            <option value="S"> Seulement un Stage </option>
                            <option value="A"> Seulement une Alternance </option>
                        </select>
                    </div>

                    <div class="input-textarea">
                        <label class="details" for="mission"> Mission </label>
                        <textarea maxlength="10000" id="mission" name="mission" required></textarea>
                    </div>

                    <div class="input-textarea">
                        <label class="details" for="fich"> Ajouter un fichier </label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="5" />
                        <input type="file" placeholder="" name="fichier" id="fich" />
                    </div>
                </div>
                    <div class="button">
                        <input type="submit" value="Envoyer"/>
                    </div>

            </form>
        </div>
    </div>
</div>
