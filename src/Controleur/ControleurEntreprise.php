<?php

namespace App\Controleur;

use App\Lib\ConnexionUtilisateur;
use App\Lib\MotDePasse;
use App\Modele\DataObject\Entreprise;
use App\Modele\HTTP\Session;
use App\Modele\Repository\EntrepriseRepository;
use App\Modele\Repository\OffreRepository;
use App\Modele\Repository\PostulerRepository;

class ControleurEntreprise extends ControleurGenerique
{


    public static function creerEntreprise(): void
    {
        if ((new EntrepriseRepository())->recupererParClePrimaire($_POST['num_siret']) != null) {
            echo '<div class="msgConfirmation"><p> ⚠️ Le numéro de Siret est déjà enregistré, veuillez contacter l\'IUT ⚠️  </p></div>';
            self::afficherInscription();
        } else {
            if ($_POST['mdp'] != $_POST['mdp2']) {
                echo '<div class="msgConfirmation"><p> ⚠️ Vos 2 champs de mot de passe ne correspondent pas ⚠️  </p></div>';
                self::afficherInscription();
            } else {
                $entreprise = Entreprise::construireDepuisFormulaire($_POST);
                EntrepriseRepository::sauvegarder($entreprise);
                echo '<div class="msgConfirmation"><p> L\'entreprise a bien été enregistrée </p></div>';
                self::afficherAccueil();
            }
        }
    }


    public static function supprimerCompteEntreprise():void{

        $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET['numSiret']);
        echo '<div class="msgConfirmation"><p> L\'entreprise ' . $entreprise->getNomEntreprise().' a été supprimée ainsi que toutes les offres associées</p></div>';
        self::afficherVue('vueGenerale.php', ["contenu" => "Generale/index.html","title"=>"Accueil"]);
        (new OffreRepository())->supprimer($_GET['idEntreprise']);
        (new EntrepriseRepository())->supprimer($_GET['numSiret']);
    }

    public static function afficherDeleteEntreprise(){
        $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
        self::afficherVue('vueGenerale.php',["contenu"=> "Entreprise/formulaireSuppressionEntreprise.php","title"=> "Supprimer Entreprise",["entreprise"=> $entreprise]]);
    }


    public static function entrepriseStageExterne(): void
    {
        $entrepriseExistante = (new EntrepriseRepository())->recupererParClePrimaire($_POST["num_siret"]);

        if ($entrepriseExistante == null) {
            $entreprise = new Entreprise($_POST["num_siret"], $_POST["nom_entreprise"], $_POST["adresse"], $_POST["telephone"], $_POST["mail"], null, $_POST["code_ape"], null, null);
            EntrepriseRepository::sauvegarder($entreprise);
            echo '<div class="msgConfirmation"><p> Vous avez bien inscrit votre entreprise du nom de : ' . $_POST["nom_entreprise"] . '</p></div>';
        }
        else {
            echo '<div class="msgConfirmation"><p> Votre entreprise est déjà inscrite </p></div>';
            self::afficherAccueil();
        }
    }


    public static function afficherGestionEntreprise()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            if (!Session::getInstance()->contient("requeteFiltreEntreprise")) {
                $entreprises = (new EntrepriseRepository())->recuperer();
            } else {
                $entreprises = (new EntrepriseRepository())->recupererAvecFiltre(Session::getInstance()->lire("requeteFiltreEntreprise"));
            }
            $tableauParPage = null;
            if ($entreprises == null) {
                $nbrePages = 1;
                $page = 1;
            } else {
                //Pagination
                $nombreEntreprise = count($entreprises);
                $nbrePages = ceil($nombreEntreprise / 9);

                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page > $nbrePages) {
                        $page = $nbrePages;
                    } else if ($page <= 1) {
                        $page = 1;
                    }
                }
                $y = $page * 9;
                if ($page * 9 > $nombreEntreprise) {
                    $y = $nombreEntreprise;
                }

                for ($i = ($page - 1) * 9; $i < $y; $i++) {
                    $tableauParPage[] = $entreprises[$i];
                }
            }
            self::afficherVue("vueGenerale.php", ["contenu" => "Entreprise/vueGestionEntreprise.php", "entreprises" => $tableauParPage, "nbrePages" => $nbrePages, "pageActuelle" => $page, "title" => "Gestion des Entreprises"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherDetailEntreprise()
    {
        if (ConnexionUtilisateur::estSecretariat() || ConnexionUtilisateur::estMaitreSA()) {
            self::afficherVue("vueGenerale.php", ["contenu" => "Entreprise/vueDetailEntreprise.php", "title" => "Detail Entreprise"]);
        } else {
            self::afficherErreur("Vous n'avez pas les droits");
        }
    }

    public static function afficherMAJEntreprise()
    {
        if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_GET["numSiret"] || ConnexionUtilisateur::estMaitreSA()) {
            $entreprise = (new EntrepriseRepository())->recupererParClePrimaire($_GET["numSiret"]);
            if ($entreprise != null) {
                self::afficherVue("Entreprise/vueMiseAJourEntreprise.php", ["entreprise" => $entreprise]);
            } else {
                self::afficherErreur("L'entreprise n'est pas enregistrée");
            }

        } else {
            self::afficherErreur("Vous n'avez pas le droit d'effectuer cela");
        }
    }

    public static function MAJEntreprise()
    {
        if (isset($_POST["num_siret"])) {
            $entrepriseAVerifier = (new EntrepriseRepository())->recupererParClePrimaire($_POST["num_siret"]);
            if (ConnexionUtilisateur::estMaitreSA()) {
                $entreprise = new Entreprise($_POST["num_siret"], $_POST["nom_entreprise"], $_POST["adresse"], $_POST["telephone"], $_POST["mail"], $_POST["interlocuteur"], $_POST["code_ape"], $_POST["activite"], $entrepriseAVerifier->getMdp());
                (new EntrepriseRepository())->mettreAJour($entreprise);
                self::afficherErreur("Les informations de l'entreprise " . $entreprise->getNomEntreprise() . " ont bien été mis à jour");
            } else if (ConnexionUtilisateur::getLoginUtilisateurConnecte() == $_POST["num_siret"]) {
                if (isset($_POST["mdp"])) {
                    $mdpCorrect = MotDePasse::verifier($_POST['mdp'], $entrepriseAVerifier->getMdp());
                    if (!$mdpCorrect) {
                        self::afficherErreur("Mot de passe Incorrect");
                    } else {
                        $entreprise = Entreprise::construireDepuisFormulaire($_POST);
                        (new EntrepriseRepository())->mettreAJour($entreprise);
                        self::afficherErreur("Les informations de votre entreprise " . $entreprise->getNomEntreprise() . " ont bien été mis à jour");
                    }
                } else {
                    self::afficherErreur("Veuillez rentrer votre mot de passe");
                }

            } else {
                self::afficherErreur("Vous n'avez pas les droits");
            }
        }
        self::afficherAccueil();
    }


    public static function rechercherEntreprise()
    {
        $values = null;
        if (isset($_POST["num_siret"]) && $_POST["num_siret"] != "") {
            $values['numSiret'] = $_POST["num_siret"];
        }
        if (isset($_POST["nom_entreprise"]) && $_POST["nom_entreprise"] != "") {
            $values['nomEntreprise'] = $_POST["nom_entreprise"];
        }
        if (isset($_POST["adresse"]) && $_POST["adresse"] != "") {
            $values['adresseEntreprise'] = $_POST["adresse"];
        }
        if (isset($_POST['interlocuteur']) && $_POST["interlocuteur"] != "") {
            $values['interlocuteurPrincipal'] = $_POST['interlocuteur'];
        }
        if (isset($_POST['mail']) && $_POST["mail"] != "") {
            $values['adressemail'] = $_POST['mail'];
        }
        if (isset($_POST['telephone']) && $_POST["telephone"] != "") {
            $values['telephoneEntreprise'] = $_POST['telephone'];
        }
        if (isset($_POST['code_ape']) && $_POST["code_ape"] != "") {
            $values['codeAPE'] = $_POST['code_ape'];
        }
        if (isset($_POST['secteur_activite']) && $_POST["secteur_activite"] != "") {
            $values['secteurActivite'] = $_POST['secteur_activite'];
        }
        Session::getInstance()->enregistrer("requeteFiltreEntreprise", $values);
        self::afficherGestionEntreprise();
    }

    public static function supprimerFiltreEntreprise()
    {
        Session::getInstance()->supprimer("requeteFiltreEntreprise");
        self::afficherGestionEntreprise();
    }


    public static function afficherVueEntrepriseCandidature(){
        $offre = (new OffreRepository())->recupererParClePrimaire($_GET['idOffre']);
        if($offre->getIdEntreprise() == ConnexionUtilisateur::getLoginUtilisateurConnecte()){
            $postulers = (new PostulerRepository())->recupererParOffre($_GET['idOffre']);
            self::afficherVue("vueGenerale.php", ["contenu" => "Entreprise/vueEntrepriseCandidature.php", "title" => "Candidatures", "postulers"=>$postulers]);
        }else{
            self::afficherErreur("Vous n'avez pas le droit de faire cela");
        }
    }

    public static function accepterCandidature(){
        $postuler = (new PostulerRepository())->recupererParClePrimaire($_GET["login"],$_GET["idOffre"]);
        $postuler->setEtat(1);
        (new PostulerRepository())->mettreAJourEtat($postuler);
        ControleurOffre::offres();
    }

    public static function refuserCandidature(){
        $postuler = (new PostulerRepository())->recupererParClePrimaire($_GET["login"],$_GET["idOffre"]);
        $postuler->setEtat(2);
        (new PostulerRepository())->mettreAJourEtat($postuler);
        ControleurOffre::offres();
    }


}