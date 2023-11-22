<?php

namespace App\Vue;

// on definit les parametres de la connexion LDAP
use App\Modele\DataObject\Etudiant;
use App\Modele\Repository\EtudiantRepository;

$ldap_host = "10.10.1.30";
$ldap_basedn = "dc=info,dc=iutmontp,dc=univ-montp2,dc=fr";
$ldap_port = 389;
$ldap_conn = false;
// on se connecte au serveur LDAP
$ldap_conn = ldap_connect($ldap_host, $ldap_port);
// on definit la version du module LDAP
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);



//$ldap_login = "crepinh";
//$ldap_password = "24022003";
//$ldap_searchfilter = "(uid=$ldap_login)";
//$search = ldap_search($ldap_conn, $ldap_basedn, $ldap_searchfilter, array());
//$user_result = ldap_get_entries($ldap_conn, $search);
//// on verifie que l’entree existe bien
//$user_exist = $user_result["count"] == 1;
//// si l’utilisateur existe bien,
//if($user_exist) {
//    $dn = "uid=".$ldap_login.",ou=Ann1,ou=Etudiants,ou=People,dc=info,dc=iutmontp,dc=univ-montp2,dc=fr";
//    $passwd_ok = ldap_bind($ldap_conn, $ldap_login, $ldap_password);
//}
  
//On recherche toutes les entres du LDAP qui sont des personnes
$search = ldap_search($ldap_conn, $ldap_basedn, "(objectClass=person)");
//On recupere toutes les entres de la recherche effectuees auparavant
$resultats = ldap_get_entries($ldap_conn, $search);
//Pour chaque utilisateur, on recupere les informations utiles
var_dump($resultats);
for ($i=0; $i < count($resultats) - 1 ; $i++) {
//On stocke le login, nom/prnom, la classe et la promotion de l’utilisateur courant
    $nomprenom = explode(" ", $resultats[$i]['displayname'][0]);
    $promotion = explode("=", explode(",", $resultats[$i]['dn'])[1])[1];
    $type = explode("=", explode(",", $resultats[$i]['dn'])[1])[1];
    //$mailEtudiant =  $resultats[$i]['mail'][0];

}

// MON CODE POUR ENREGISTRER LES COMPTES :
foreach($resultats as $resultat){
    if($type != "Personnel"){
        //$etudiant = new Etudiant();
    }
}

//on ferme la connection au LDAP
ldap_close($ldap_conn); //idem ldap_unbind($ldap_conn);
