<?php
echo '<form method="post" action="controleurFrontal.php?action=postuler&idOffre='.$offreId.'" enctype="multipart/form-data">';
    ?>
    <div class="title"> Création d'une offre par une entreprise</div>
    <div class="user-details">
        <div class="input-textarea">
            <label class="details" for="fich"> Ajouter votre CV *</label>
            <input type="file" placeholder="" name="cvEtu" id="fich" required/>
        </div>

        <div class="input-textarea">
            <label class="details" for="fich2"> Ajouter une lettre de motivation (facultatif)</label>
            <input type="file" placeholder="" name="lettreMotivation" id="fich2" />
        </div>
    </div>
    <div class="button">
        <input type="submit" value="Envoyer"/>
    </div>

</form>

