<?php

namespace App\Modele\HTTP;

class Cookie
{
    public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void{
        $valeurString = serialize($valeur);
        if($dureeExpiration == null){
            $dureeExpiration = 0;
        }

        setcookie($cle,$valeurString,$dureeExpiration);
    }
    public static function lire(string $cle) : mixed{
        return unserialize($_COOKIE[$cle]);
    }

    public static function contient($cle) : bool{
        if(isset($_COOKIE[$cle])){
            return true;
        }else{
            return false;
        }
    }

    public static function supprimer($cle) : void{
        unset($_COOKIE[$cle]);
    }
}