<?php
namespace App\Controleur;

use App\Configuration\Configuration;
use mysqli;
use PDO;
use PDOException;


// Maintenant vous pouvez utiliser les méthodes statiques de Configuration
$login = Configuration::getLogin();
$hostname = Configuration::getHostname();
// ...

try {
    $pdo = new PDO(
        'mysql:host=' . Configuration::getHostname() . ';dbname=' . Configuration::getDatabase() . ';charset=utf8',
        Configuration::getLogin(),
        Configuration::getPassword()
    );

    // Vous êtes maintenant connecté à la base de données.
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}


// Assurez-vous que le chemin d'accès au fichier de configuration est correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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


?>
