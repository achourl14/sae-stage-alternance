<?php
namespace App\Controleur;

use App\Configuration\Configuration;
use mysqli;
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




