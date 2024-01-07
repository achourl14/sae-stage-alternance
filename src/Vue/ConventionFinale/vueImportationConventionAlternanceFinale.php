<head>
    <link rel="stylesheet" href="styles/css/style_inscription.css">
</head>

<div class="contient">
    <div class="container">
        <div class="title">Inscription Etudiant</div>
        <div class="content">
            <form class="formulaire" action="controleurFrontal.php?controleur=convention&action=importerConventionAlternance"
                  method="post" enctype="multipart/form-data">
                <div class="user-details">
<!--                    <div class="input-box">-->
                        <span class="details">Sélectionnez un fichier CSV à importer en tant que convention :</span>
                        <input type="file" name="fileToUpload" id="file" accept=".csv">
<!--                    </div>-->
                </div>
                <div class="button">
                    <input type="submit" value="Importer">
                </div>
            </form>
        </div>
    </div>
</div>

