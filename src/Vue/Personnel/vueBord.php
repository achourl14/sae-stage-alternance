<?php

use App\Modele\HTTP\Session;
use App\Modele\Repository\EtudiantRepository;

$recherche = null;
$rechercheConvention = null;
if (Session::getInstance()->contient("requeteFiltreTB")) {
    $recherche = Session::getInstance()->lire("requeteFiltreTB");
}
$but0 = "";
$but2 = "";
$but3 = "";
if (isset($recherche["promotion"])) {
    if ($recherche["promotion"] == "0") {
        $but0 = "selected";
    } else if ($recherche["promotion"] == "2") {
        $but2 = "selected";
    } else {
        $but3 = "selected";
    }
}

$pedag = "checked";
$finale = "";
if (Session::getInstance()->contient("requeteFiltreTBConvention")) {
    $rechercheConvention = Session::getInstance()->lire("requeteFiltreTBConvention");
}
if (isset($rechercheConvention["validation"])) {
    if ($rechercheConvention["validation"] == "pedagogique") {
        $pedag = "checked";
    } else {
        $finale = "checked";
        $pedag = "";
    }
}


?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        //Récupération des variables en php vers javascript qui lit la base de données avec des requetes =
        var nombreStageTrouve = <?php echo json_encode($nombreStageTrouve); ?>;
        var nombreAlternanceTrouve = <?php echo json_encode($nombreAlternanceTrouve); ?>;
        var nombreEnRecherche = <?php echo json_encode($nombreEnRecherche); ?>;

        var nbreConventionValidePedagogique = <?php echo json_encode($nbreConventionValidePedagogique); ?>;
        var nbreConventionNonValidePedagogique = <?php echo json_encode($nbreConventionNonValidePedagogique); ?>;

        //Fonction appelé en javascript
        function drawChart() {

            //API de google pour faire des graphiques
            // nom de chaque partie du graphique ainsi que ses valeurs
            var data = google.visualization.arrayToDataTable([
                ['types', 'nombres'],
                ['En recherche', nombreEnRecherche],
                ['Stage Trouvé', nombreStageTrouve],
                ['Alternance Trouvé', nombreAlternanceTrouve]
            ]);

            var options = {
                title: 'Recherches Stage et Alternance'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart-SA'));

            chart.draw(data, options);

            var dataConvention = google.visualization.arrayToDataTable([
                ['Conventions', 'nombres'],
                ['Convention Validé', nbreConventionValidePedagogique],
                ['Convention Non validé', nbreConventionNonValidePedagogique]
            ]);

            var optionsConvention = {
                title: 'Conventions'
            };

            var chartC = new google.visualization.PieChart(document.getElementById('piechartConvention'));

            chartC.draw(dataConvention, optionsConvention);
        }
    </script>

    <div class='title'> Tableau de bord</div>

<?php
echo '<div class="margeBord">';
if ($cpt != 0) {
    echo '<div class="page">';
    echo '<a href="https://webinfo.iutmontp.univ-montp2.fr/~crepinh/SAE/web/controleurFrontal.php?controleur=personnel&action=afficherConventionEnAttente">  '.$cpt.' Convention(s) en attente de validation (que vous n\'avez pas consultée(s)) </a>';
    echo '</div>';
}
echo '</div>';
?>
    <div class="tableauDeBord">
        <div>
            <form method="post" class="formulaire formTB"
                  action="controleurFrontal.php?controleur=personnel&action=filtrerTB">
                <div class="user-details">
                    <div class="input-box-TB">
                        <label class="details" for="annee"> Année de BUT </label>
                        <select name="but_annee" id="annee" required>
                            <option value="0" <?php echo $but0 ?>>Toutes les années</option>
                            <option value="2" <?php echo $but2 ?>>BUT 2 (2ème année)</option>
                            <option value="3" <?php echo $but3 ?>>BUT 3 (3ème année)</option>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Rechercher">
                </div>
            </form>
            <div id="piechart-SA" style="width: 800px; height: 400px;"></div>
        </div>

        <div class="tableauDeBord">
            <div>
                <form method="post" class="formulaire formTB"
                      action="controleurFrontal.php?controleur=personnel&action=filtrerTB">
                    <div class="user-details">
                        <div class="input-box-TB">
                            <label class="details" for="annee"> Validation </label>
                            <div class="radio">
                                <input type="radio" id="pedagogique" name="validation"
                                       value="pedagogique" <?php echo $pedag ?>>
                                <label for="pedagogique">Pédagogique</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="finale" name="validation" value="finale" <?php echo $finale ?>>
                                <label for="finale">Finale</label>
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Rechercher">
                    </div>
                </form>
                <div id="piechartConvention" style="width: 800px; height: 400px;"></div>
            </div>
        </div>
    </div>

    <div class="bord">

        <div class="bordListeBouton">
            <div>
                <a class="boutonBord" href="controleurFrontal.php?controleur=Personnel&action=afficherEtudiantStage">Liste
                    des étudiants en stage</a>
            </div>
            <div>
                <a class="boutonBord"
                   href="controleurFrontal.php?controleur=Personnel&action=afficherEtudiantAlternance">Liste des
                    étudiants en Alternance</a>
            </div>
            <div>
                <a class="boutonBord"
                   href="controleurFrontal.php?controleur=Personnel&action=afficherListeEntrepriseStage">Liste des
                    entreprise avec un stagiaire</a>
            </div>
            <div>
                <a class="boutonBord"
                   href="controleurFrontal.php?controleur=Personnel&action=afficherListeEntrepriseAlternance">Liste des
                    entreprise avec un Alternant</a>
            </div>
        </div>
    </div>
<?php

