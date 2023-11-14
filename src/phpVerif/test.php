<?php

namespace App\phpVerif;
use App\Configuration\Configuration;
use Exception;
use mysqli;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codeINE = $_POST['codeINE'];

        // Connexion à la base de données
        $conn = new mysqli(Configuration::getHostname(), Configuration::getLogin(), Configuration::getPassword(), Configuration::getDatabase(), Configuration::getPort());

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Requête SQL pour vérifier l'existence de l'étudiant
        $query = "SELECT * FROM etudiants WHERE code_ine = '$codeINE'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "L'étudiant existe.";
        } else {
            echo "L'étudiant n'existe pas.";
        }

        $conn->close();
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>
