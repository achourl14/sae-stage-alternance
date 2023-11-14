<body>
    <form class="formulaireSuppressionEntreprise" method="post" action="controleurFrontal.php">
        <div class="div">
            <div>
                <p class="p"> Voules-vous supprimer votre compte ?</p>
                <p class="p">Ceci entrainera la suppression de toutes les offres de l'entreprise</p>
            </div>
        </div>
        <div class="buttonSuppressionEntreprise">
            <?php $num = $_GET['numSiret'];
            echo "<input class='oui' type='submit' value='Oui' formaction='controleurFrontal.php?action=supprimerCompteEntreprise&numSiret={$_GET['numSiret']}'>";
            echo "<input class='non' type='submit' value='Non' formaction='controleurFrontal.php?action=afficherDetailEntreprise&numSiret={$_GET['numSiret']}'>";

            ?>
            </div>
    </form>
</body>