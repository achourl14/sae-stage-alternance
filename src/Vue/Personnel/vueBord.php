<?php
    use App\Modele\Repository\EtudiantRepository;
    $nombreStageTrouve = (new EtudiantRepository())->nombreDePersonneTrouveStage();
    $nombreAlternanceTrouve = (new EtudiantRepository())->nombreDePersonneTrouveAlternance();
    //var_dump((new EtudiantRepository())->nombreEtudiant());
$nombreEnRecherche = (new EtudiantRepository())->nombreEtudiant() - $nombreStageTrouve - $nombreAlternanceTrouve;
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var nombreStageTrouve = <?php echo json_encode($nombreStageTrouve); ?>;
    var nombreAlternanceTrouve = <?php echo json_encode($nombreAlternanceTrouve); ?>;
    var nombreEnRecherche = <?php echo json_encode($nombreEnRecherche); ?>;
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['En recherche',  nombreEnRecherche],
            ['Stage Trouvé', nombreStageTrouve],
            ['Alternance Trouvé', nombreAlternanceTrouve]
        ]);

        var options = {
            title: 'Personnes en stage'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
<div id="piechart" style="width: 900px; height: 500px;"></div>

<?php

