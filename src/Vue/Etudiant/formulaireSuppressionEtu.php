<body>
<form class="formulaireSuppressionEntreprise" method="post" action="controleurFrontal.php">
    <div class="div">
        <div>
            <p class="p"> Voules-vous supprimer l'étudiant ?</p>
        </div>
    </div>
    <div class="buttonSuppressionEntreprise">
        <?php $code = $_GET['login'];
        echo "<input class='oui' type='submit' value='Oui' formaction='controleurFrontal.php?controleur=etudiant&action=supprimerEtu&login={$_GET['login']}'>";
        echo "<input class='non' type='submit' value='Non' formaction='controleurFrontal.php?controleur=etudiant&action=afficherDetailEtudiant&login={$_GET['login']}'>";

        ?>
    </div>
</form>
</body>