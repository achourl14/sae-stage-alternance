<?php

namespace App\Controleur;

class ControleurGenerique
{
    protected static function afficherVue(string $cheminVue, array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require ("../src/Vue/$cheminVue"); // Charge la vue
    }
}