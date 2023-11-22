<body>
<form class="formulaireSuppressionEntreprise" method="post" action="controleurFrontal.php">
    <div class="div">
        <div>
            <p class="p"> Voules-vous supprimer l'étudiant ?</p>
        </div>
    </div>
    <div class="buttonSuppressionEntreprise">
        <?php $code = $_GET['codeINE'];
        echo "<input class='oui' type='submit' value='Oui' formaction='controleurFrontal.php?action=supprimerEtu&codeINE={$_GET['codeINE']}'>";
        echo "<input class='non' type='submit' value='Non' formaction='controleurFrontal.php?action=afficherDetailEtudiant&codeINE={$_GET['codeINE']}'>";

        ?>
    </div>
</form>
</body>