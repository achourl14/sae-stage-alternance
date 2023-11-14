<?php

namespace App\Controleur;
use App\Configuration\Configuration;
use PDO;
use PDOException;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codeINE = $_POST['codeINE'];

    // Exécutez une requête SQL pour vérifier si l'étudiant existe
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM etudiants WHERE codeINE = ?');
    $stmt->execute([$codeINE]);
    $result = $stmt->fetchColumn();

    // Retournez une réponse JSON
    header('Content-Type: application/json');
    echo json_encode(['exists' => ($result > 0)]);
    exit;
}

?>
