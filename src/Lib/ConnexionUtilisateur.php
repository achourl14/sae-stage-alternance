<?php

namespace App\Lib;

use App\Modele\HTTP\Cookie;
use App\Modele\HTTP\Session;
use App\Modele\Repository\SecretariatRepository;

class ConnexionUtilisateur
{
    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        $session = Session::getInstance();
        $session->enregistrer(self::$cleConnexion, $loginUtilisateur);

    }

    public static function estConnecte(): bool
    {
        return Session::getInstance()->contient(self::$cleConnexion);
    }

    public static function deconnecter(): void
    {
        Session::getInstance()->supprimer(self::$cleConnexion);
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
        Cookie::supprimer(session_name()); // deletes the session cookie
        // Il faudra reconstruire la session au prochain appel de getInstance()
        $instance = null;
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        if(self::estConnecte()){
            return Session::getInstance()->lire(self::$cleConnexion);
        }else{
            return null;
        }
    }

    public static function estUtilisateur($login): bool{
        if(self::estConnecte() && $login == self::getLoginUtilisateurConnecte()){
            return true;
        }else{
            return false;
        }
    }

    public static function estPersonnel(): bool{
        if(Session::getInstance()->contient('secretariat')){
            return true;
        }else{
            return false;
        }
    }

    public static function estSecretariat() : bool{
        if(Session::getInstance()->contient('secretariat')){
            $personnel = (new SecretariatRepository())->recupererParClePrimaire(self::getLoginUtilisateurConnecte());
            if($personnel->getRole() == "S"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function estMaitreSA() : bool{
        if(Session::getInstance()->contient('secretariat')){
            $personnel = (new SecretariatRepository())->recupererParClePrimaire(self::getLoginUtilisateurConnecte());
            if($personnel->getRole() == "M"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function estEtudiant() : bool{
        if(Session::getInstance()->contient('etudiant')){
            return true;
        }else{
            return false;
        }
    }

    public static function estEntreprise() : bool{
        if(Session::getInstance()->contient('entreprise')){
            return true;
        }else{
            return false;
        }
    }
}