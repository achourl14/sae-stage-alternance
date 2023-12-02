<?php

echo "<div class='title'> Tableau de bord </div>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
        }

        .section {
            margin-bottom: 20px;
        }

        .table {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .row {
            display: table-row;
        }

        .cell {
            display: table-cell;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .cell.bold {
            font-weight: bold;
        }

        .cell.align-center {
            text-align: center;
        }

        .cell.align-right {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="section">
        <h2>Visites</h2>
        <table class="table">
            <tr class="row">
                <td class="cell cell-bold align-center">Période</td>
                <td class="cell cell-bold align-center">Visites</td>
                <td class="cell cell-bold align-center">Pages vues</td>
            </tr>
            <!-- Remplacez ces lignes par vos données réelles -->
            <tr class="row">
                <td class="cell align-center">29 janv.</td>
                <td class="cell align-center">40</td>
                <td class="cell align-center">20</td>
            </tr>
            <tr class="row">
                <td class="cell align-center">5 févr.</td>
                <td class="cell align-center">12</td>
                <td class="cell align-center">29</td>
            </tr>
            <!-- Fin des données -->
        </table>
    </div>

    <!-- Récupérez le code HTML et CSS pour les autres sections similaires et ajoutez-les ici -->

</div>
</body>
</html>
