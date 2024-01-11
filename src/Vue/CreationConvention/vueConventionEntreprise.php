<?php
?>
<div class="contient">
    <div class="container">
        <div class="content">
            <form method="post" class="formulaire"
                  action="controleurFrontal.php?controleur=convention&action=MiseAJourConventionEntreprise">
                <div class="title">Convention</div>

                <div class='page'>
                    <div><p>Etudiant</p></div>
                    <div><p class="activeP">Entreprise</p></div>
                    <div><p>Details du stage</p></div>
                    <div><p>Autres</p></div>
                </div>

                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Numero Convention</span>
                        <input type="text" name="numConvention" required readonly
                               value=<?php echo $convention->getNumConvention() ?>>
                    </div>

                    <div class="input-box">
                        <span class="details">Nom de l'établissement</span>
                        <input type="text" placeholder="" name="nomEtablissement" maxlength="50"
                               value=<?php echo $convention->getNomEtablissement() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de Siret </span>
                        <input type="text" placeholder="" name="siret" maxlength="14" required
                               value=<?php echo $convention->getSiret() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse de résidence</span>
                        <input type="text" placeholder="" name="adresseResidence" maxlength="50"
                               value=<?php echo $convention->getAdresseResidence() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse voie</span>
                        <input type="text" placeholder="" name="adresseVoie" maxlength="50"
                               value=<?php echo $convention->getAdresseVoie() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse de libellé Cedex</span>
                        <input type="text" placeholder="" name="adresseLibCedex" maxlength="50"
                               value=<?php echo $convention->getAdresseLibCedex() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code postal</span>
                        <input type="Number" placeholder="" name="codePostal"
                               maxlength="11" value=<?php echo $convention->getCodePostal() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Commune de l'établissement d'acceuil</span>
                        <input type="text" placeholder="" name="communeEtabAcceuil" maxlength="50"
                               value=<?php echo $convention->getCommuneEtabAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Pays de l'établissement</span>
                        <input type="text" placeholder="" name="paysEtablissement" maxlength="50"
                               value=<?php echo $convention->getPaysEtablissement() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Statut juridique</span>
                        <input type="text" placeholder="" name="statutJuridique" maxlength="50"
                               value=<?php echo $convention->getStatutJuridique() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Type de la structure</span>
                        <input type="text" placeholder="" name="typeStructure" maxlength="50"
                               value=<?php echo $convention->getTypeStructure() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Effectif</span>
                        <input type="text" placeholder="" name="effectif" maxlength="20"
                               value=<?php echo $convention->getEffectif() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code NAF</span>
                        <input type="text" placeholder="" name="codeNAF" maxlength="20"
                               value=<?php echo $convention->getCodeNAF() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de téléphone de l'établissement</span>
                        <input type="text" placeholder="" name="telEtablissement" maxlength="10"
                               value=<?php echo $convention->getTelEtablissement() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Fax</span>
                        <input type="text" placeholder="" name="fax" maxlength="20"
                               value=<?php echo $convention->getFax() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail de l'établissement</span>
                        <input type="text" placeholder="" name="mailEtablissement" maxlength="50"
                               value=<?php echo $convention->getMailEtablissement() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Site web</span>
                        <input type="text" placeholder="" name="siteWeb" maxlength="200"
                               value=<?php echo $convention->getSiteWeb() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Nom du service d'accueil</span>
                        <input type="text" placeholder="" name="nomServiceAcceuil" maxlength="50"
                               value=<?php echo $convention->getNomServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Résidence du service d'accueil</span>
                        <input type="text" placeholder="" name="residenceServiceAcceuil" maxlength="50"
                               value=<?php echo $convention->getResidenceServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Voie du service d'accueil</span>
                        <input type="text" placeholder="" name="voieServiceAcceuil" maxlength="50"
                               value=<?php echo $convention->getVoieServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Cedex du service d'accueil</span>
                        <input type="text" placeholder="" name="cedexServiceAcceuil" maxlength="50"
                               value=<?php echo $convention->getCedexServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Code postal du service d'accueil</span>
                        <input type="number" placeholder="" name="codePostalServiceAcceuil" maxlength="11"
                               value=<?php echo $convention->getCodePostalServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Commune du service d'accueil</span>
                        <input type="text" placeholder="" name="communeServiceAcceuil" maxlength="50"
                               value=<?php echo $convention->getCommuneServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Pays du service d'accueil</span>
                        <input type="text" placeholder="" name="paysServiceAcceuil" maxlength="50"
                               value=<?php echo $convention->getPaysServiceAcceuil() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Nom du tuteur professionnel</span>
                        <input type="text" placeholder="" name="nomTuteurProfessionnel" maxlength="50"
                               value=<?php echo $convention->getNomTuteurProfessionnel() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Prenom du tuteur professionnel</span>
                        <input type="text" placeholder="" name="prenomTuteurProfessionnel" maxlength="50"
                               value=<?php echo $convention->getPrenomTuteurProfessionnel() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Adresse mail du tuteur professionnel</span>
                        <input type="text" placeholder="" name="mailTuteurProfessionnel" maxlength="50"
                               value=<?php echo $convention->getMailTuteurProfessionnel() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Numéro de téléphone du tuteur professionnel</span>
                        <input type="text" placeholder="" name="telTuteurProfessionnel" maxlength="50"
                               value=<?php echo $convention->getTelTuteurProfessionnel() ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Fonction du tuteur professionnel</span>
                        <input type="text" placeholder="" name="fonctionTuteurProfessionnel" maxlength="50"
                               value=<?php echo $convention->getFonctionTuteurProfessionnel() ?>>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Suivant">
                </div>
            </form>
        </div>
    </div>
</div>
