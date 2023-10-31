<?php

namespace App\Controleur;

class ControleurGenerique
{
    protected static function afficherVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require("../src/Vue/$cheminVue"); // Charge la vue
    }

    public static function getURI()
    {
        $adresse = $_SERVER['PHP_SELF'];
        $i = 0;
        foreach ($_GET as $cle => $valeur) {
            $adresse .= ($i == 0 ? '?' : '&') . $cle . ($valeur ? '=' . $valeur : '');
            $i++;
        }
        return $adresse;
    }
}