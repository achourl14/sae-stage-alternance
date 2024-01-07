<?php

namespace App\Modele\DataObject;

class ConventionAlternance extends AbstractDataObject
{
    private ?string $archivee;
    private ?string $gereEnDehorsDeStudea;
    private ?string $statutsOPCO;
    private ?int $id;
    private ?string $etablissement;
    private ?string $formation;
    private ?string $anneeDebut;
    private ?string $anneeFin;
    private ?string $genreAlternantEtu;
    private ?string $nomAlternantEtu;
    private ?string $prenomAlternantEtu;
    private ?string $DateDeSaisieParEntreprise;
    private ?string $validationPedagogiqueMission;
    private ?string $ficheEnErreur;
    private ?string $codeErreur;
    private ?string $contratEtConventionEnvoyeEntreprise;
    private ?string $contratEtOuConventionSigne;
    private ?string $dateNaissance;
    private ?string $communeNaissance;
    private ?string $paysNaissance;
    private ?string $nationalite;
    private ?string $travailleurHandicape;
    private ?string $titulairePermisConduire;
    private ?string $numeroSecuriteSociale;
    private ?string $pasDeNumeroSecuriteSociale;
    private ?string $sportifHautNiveau;
    private ?string $telephone1;
    private ?string $telephone2;
    private ?string $email1;
    private ?string $email2;
    private ?string $adresse;
    private ?string $complement;
    private ?string $codePostal;
    private ?string $ville;
    private ?string $genreRepresentantLegal;
    private ?string $nomRepresentantLegal;
    private ?string $prenomRepresentantLegal;
    private ?string $adresse2;
    private ?string $complement2;
    private ?string $codePostal2;
    private ?string $ville2;
    private ?string $codeINE;
    private ?string $situationAvantContrat;
    private ?string $paysDernierDiplomePrepare;
    private ?string $departementDernierDiplomePrepare;
    private ?string $etablissementDernierDiplomePrepare;
    private ?string $UAIEtablissementDernierDiplomePrepare;
    private ?string $typeDiplome;
    private ?string $annee;
    private ?string $intitule;
    private ?string $obtention;
    private ?string $derniereAnneeOuClasseSuivie;
    private ?string $dernierDiplomeObtenue;
    private ?string $entrepriseTemporaire;
    private ?string $nomContactTemporaire;
    private ?string $prenomContactTemporaire;
    private ?string $emailContactTemporaire;
    private ?string $telephoneContactTemporaire;
    private ?string $siret;
    private ?string $typeEmployeur;
    private ?string $raisonSociale;
    private ?string $codeNAF;
    private ?string $caisseRetraiteComplementaire;
    private ?string $effectifTotal;
    private ?string $adresseContact;
    private ?string $complementAdresseContact;
    private ?string $codePostalContact;
    private ?string $villeContact;
    private ?string $adresseContact2;
    private ?string $complementAdresseContact2;
    private ?string $codePostalContact2;
    private ?string $villeContact2;
    private ?string $genreDuDirecteur;
    private ?string $nomDirecteur;
    private ?string $prenomDirecteur;
    private ?string $fonctionDirecteur;
    private ?string $emailDirecteur;
    private ?string $siretAdministration;

    private ?string $typeEmployeurDirecteur;
    private ?string $raisonSocialDirecteur;
    private ?string $codeNAFDirecteur;
    private ?string $caisseRetraiteComplementaireDirecteur;
    private ?string $effectifTotalDirecteur;
    private ?string $adresseDirecteur;
    private ?string $complementAdresseDirecteur;
    private ?string $codePostalDirecteur;
    private ?string $villeDirecteur;
    private ?string $genreDirecteur2;
    private ?string $nomDirecteur2;
    private ?string $prenomDirecteur2;
    private ?string $fonctionDirecteur2;
    private ?string $emailDirecteur2;
    private ?string $genreInterlocuteurRH;
    private ?string $nomInterlocuteurRH;
    private ?string $prenomInterlocuteurRH;
    private ?string $fonctionInterlocuteurRH;
    private ?string $emailInterlocuteurRH;
    private ?string $OPCO;
    private ?string $IDCC;
    private ?string $codeIDCC;
    private ?string $missionSaisie;
    private ?string $fichierJointMission;
    private ?string $mandatCFA;
    private ?string $typeContrat;
    private ?string $dateDebutContrat;
    private ?string $dateFinContrat;
    private ?string $genreMaitreApprentissage;
    private ?string $nomMaitreApprentissage;
    private ?string $prenomMaitreApprentissage;
    private ?string $fonctionMaitreApprentissage;
    private ?string $telephoneMaitreApprentissage;
    private ?string $emailMaitreApprentissage;
    private ?string $dateNaissanceMaitreApprentissage;
    private ?string $dejaMaitreApprentissage;
    private ?string $dejaFormationMaitreApprentissage;
    private ?string $genreSecondMaitreApprentissage;
    private ?string $nomSecondMaitreApprentissage;
    private ?string $prenomSecondMaitreApprentissage;
    private ?string $fonctionSecondMaitreApprentissage;
    private ?string $telephoneSecondMaitreApprentissage;
    private ?string $emailSecondMaitreApprentissage;
    private ?string $dateNaissanceSecondMaitreApprentissage;
    private ?string $dejaSecondMaitreApprentissage;
    private ?string $dejaFormationSecondMaitreApprentissage;
    private ?string $responsableDeFormation;
    private ?string $validateurDevis;
    private ?string $dureeContrat;
    private ?string $coutContrat;
    private ?string $montantPriseEnChargeNPEC;
    private ?string $montantResteCharge;
    private ?string $coutFormationAnnee;
    private ?string $coutContratAvantNegociation;
    private ?string $numeroDECA;
    private ?string $codeDiplome;
    private ?string $codeRNCP;
    private ?string $SFP;
    private ?string $dateEnvoieSFP;
    private ?string $gestionnaireEnvoieSFP;
    private ?string $dureeSFP;
    private ?string $dateDebutFormation;
    private ?string $dateFinFormation;
    private ?string $etablissementDocEmployeur;
    private ?string $dateEtablissementDocEmployeur;

    /**
     * @param bool|null $archivee
     * @param bool|null $gereEnDehorsDeStudea
     * @param string|null $statutsOPCO
     * @param int|null $id
     * @param string|null $etablissement
     * @param string|null $formation
     * @param int|null $anneeDebut
     * @param int|null $anneeFin
     * @param string|null $genreAlternantEtu
     * @param string|null $nomAlternantEtu
     * @param string|null $prenomAlternantEtu
     * @param string|null $DateDeSaisieParEntreprise
     * @param string|null $validationPedagogiqueMission
     * @param string|null $ficheEnErreur
     * @param string|null $codeErreur
     * @param string|null $contratEtConventionEnvoyeEntreprise
     * @param string|null $contratEtOuConventionSigne
     * @param string|null $dateNaissance
     * @param string|null $communeNaissance
     * @param string|null $paysNaissance
     * @param string|null $nationalite
     * @param bool|null $travailleurHandicape
     * @param bool|null $titulairePermisConduire
     * @param string|null $numeroSecuriteSociale
     * @param bool|null $pasDeNumeroSecuriteSociale
     * @param bool|null $sportifHautNiveau
     * @param string|null $telephone1
     * @param string|null $telephone2
     * @param string|null $email1
     * @param string|null $email2
     * @param string|null $adresse
     * @param string|null $complement
     * @param string|null $codePostal
     * @param string|null $ville
     * @param string|null $genreRepresentantLegal
     * @param string|null $nomRepresentantLegal
     * @param string|null $prenomRepresentantLegal
     * @param string|null $adresse2
     * @param string|null $complement2
     * @param string|null $codePostal2
     * @param string|null $ville2
     * @param string|null $codeINE
     * @param string|null $situationAvantContrat
     * @param string|null $paysDernierDiplomePrepare
     * @param string|null $departementDernierDiplomePrepare
     * @param string|null $etablissementDernierDiplomePrepare
     * @param string|null $UAIEtablissementDernierDiplomePrepare
     * @param string|null $typeDiplome
     * @param int|null $annee
     * @param string|null $intitule
     * @param string|null $obtention
     * @param string|null $derniereAnneeOuClasseSuivie
     * @param string|null $dernierDiplomeObtenue
     * @param string|null $entrepriseTemporaire
     * @param string|null $nomContactTemporaire
     * @param string|null $prenomContactTemporaire
     * @param string|null $emailContactTemporaire
     * @param string|null $telephoneContactTemporaire
     * @param string|null $siret
     * @param string|null $typeEmployeur
     * @param string|null $raisonSociale
     * @param string|null $codeNAF
     * @param string|null $caisseRetraiteComplementaire
     * @param int|null $effectifTotal
     * @param string|null $adresseContact
     * @param string|null $complementAdresseContact
     * @param string|null $codePostalContact
     * @param string|null $villeContact
     * @param string|null $adresseContact2
     * @param string|null $complementAdresseContact2
     * @param string|null $codePostalContact2
     * @param string|null $villeContact2
     * @param string|null $genreDuDirecteur
     * @param string|null $nomDirecteur
     * @param string|null $prenomDirecteur
     * @param string|null $fonctionDirecteur
     * @param string|null $emailDirecteur
     * @param string|null $siretAdministration
     * @param string|null $typeEmployeurDirecteur
     * @param string|null $raisonSocialDirecteur
     * @param string|null $codeNAFDirecteur
     * @param string|null $caisseRetraiteComplementaireDirecteur
     * @param int|null $effectifTotalDirecteur
     * @param string|null $adresseDirecteur
     * @param string|null $complementAdresseDirecteur
     * @param string|null $codePostalDirecteur
     * @param string|null $villeDirecteur
     * @param string|null $genreDirecteur2
     * @param string|null $nomDirecteur2
     * @param string|null $prenomDirecteur2
     * @param string|null $fonctionDirecteur2
     * @param string|null $emailDirecteur2
     * @param string|null $genreInterlocuteurRH
     * @param string|null $nomInterlocuteurRH
     * @param string|null $prenomInterlocuteurRH
     * @param string|null $fonctionInterlocuteurRH
     * @param string|null $emailInterlocuteurRH
     * @param string|null $OPCO
     * @param string|null $IDCC
     * @param string|null $codeIDCC
     * @param string|null $missionSaisie
     * @param string|null $fichierJointMission
     * @param string|null $mandatCFA
     * @param string|null $typeContrat
     * @param string|null $dateDebutContrat
     * @param string|null $dateFinContrat
     * @param string|null $genreMaitreApprentissage
     * @param string|null $nomMaitreApprentissage
     * @param string|null $prenomMaitreApprentissage
     * @param string|null $fonctionMaitreApprentissage
     * @param string|null $telephoneMaitreApprentissage
     * @param string|null $emailMaitreApprentissage
     * @param string|null $dateNaissanceMaitreApprentissage
     * @param bool|null $dejaMaitreApprentissage
     * @param bool|null $dejaFormationMaitreApprentissage
     * @param string|null $genreSecondMaitreApprentissage
     * @param string|null $nomSecondMaitreApprentissage
     * @param string|null $prenomSecondMaitreApprentissage
     * @param string|null $fonctionSecondMaitreApprentissage
     * @param string|null $telephoneSecondMaitreApprentissage
     * @param string|null $emailSecondMaitreApprentissage
     * @param string|null $dateNaissanceSecondMaitreApprentissage
     * @param bool|null $dejaSecondMaitreApprentissage
     * @param bool|null $dejaFormationSecondMaitreApprentissage
     * @param string|null $responsableDeFormation
     * @param string|null $validateurDevis
     * @param string|null $dureeContrat
     * @param float|null $coutContrat
     * @param float|null $montantPriseEnChargeNPEC
     * @param float|null $montantResteCharge
     * @param float|null $coutFormationAnnee
     * @param float|null $coutContratAvantNegociation
     * @param string|null $numeroDECA
     * @param string|null $codeDiplome
     * @param string|null $codeRNCP
     * @param string|null $SFP
     * @param string|null $dateEnvoieSFP
     * @param string|null $gestionnaireEnvoieSFP
     * @param string|null $dureeSFP
     * @param string|null $dateDebutFormation
     * @param string|null $dateFinFormation
     * @param string|null $etablissementDocEmployeur
     * @param string|null $dateEtablissementDocEmployeur
     */
    public function __construct(?string $archivee, ?string $gereEnDehorsDeStudea, ?string $statutsOPCO, ?int $id, ?string $etablissement, ?string $formation, ?string $anneeDebut, ?string $anneeFin, ?string $genreAlternantEtu, ?string $nomAlternantEtu, ?string $prenomAlternantEtu, ?string $DateDeSaisieParEntreprise, ?string $validationPedagogiqueMission, ?string $ficheEnErreur, ?string $codeErreur, ?string $contratEtConventionEnvoyeEntreprise, ?string $contratEtOuConventionSigne, ?string $dateNaissance, ?string $communeNaissance, ?string $paysNaissance, ?string $nationalite, ?string $travailleurHandicape, ?string $titulairePermisConduire, ?string $numeroSecuriteSociale, ?string $pasDeNumeroSecuriteSociale, ?string $sportifHautNiveau, ?string $telephone1, ?string $telephone2, ?string $email1, ?string $email2, ?string $adresse, ?string $complement, ?string $codePostal, ?string $ville, ?string $genreRepresentantLegal, ?string $nomRepresentantLegal, ?string $prenomRepresentantLegal, ?string $adresse2, ?string $complement2, ?string $codePostal2, ?string $ville2, ?string $codeINE, ?string $situationAvantContrat, ?string $paysDernierDiplomePrepare, ?string $departementDernierDiplomePrepare, ?string $etablissementDernierDiplomePrepare, ?string $UAIEtablissementDernierDiplomePrepare, ?string $typeDiplome, ?string $annee, ?string $intitule, ?string $obtention, ?string $derniereAnneeOuClasseSuivie, ?string $dernierDiplomeObtenue, ?string $entrepriseTemporaire, ?string $nomContactTemporaire, ?string $prenomContactTemporaire, ?string $emailContactTemporaire, ?string $telephoneContactTemporaire, ?string $siret, ?string $typeEmployeur, ?string $raisonSociale, ?string $codeNAF, ?string $caisseRetraiteComplementaire, ?string $effectifTotal, ?string $adresseContact, ?string $complementAdresseContact, ?string $codePostalContact, ?string $villeContact, ?string $adresseContact2, ?string $complementAdresseContact2, ?string $codePostalContact2, ?string $villeContact2, ?string $genreDuDirecteur, ?string $nomDirecteur, ?string $prenomDirecteur, ?string $fonctionDirecteur, ?string $emailDirecteur, ?string $siretAdministration, ?string $typeEmployeurDirecteur, ?string $raisonSocialDirecteur, ?string $codeNAFDirecteur, ?string $caisseRetraiteComplementaireDirecteur, ?string $effectifTotalDirecteur, ?string $adresseDirecteur, ?string $complementAdresseDirecteur, ?string $codePostalDirecteur, ?string $villeDirecteur, ?string $genreDirecteur2, ?string $nomDirecteur2, ?string $prenomDirecteur2, ?string $fonctionDirecteur2, ?string $emailDirecteur2, ?string $genreInterlocuteurRH, ?string $nomInterlocuteurRH, ?string $prenomInterlocuteurRH, ?string $fonctionInterlocuteurRH, ?string $emailInterlocuteurRH, ?string $OPCO, ?string $IDCC, ?string $codeIDCC, ?string $missionSaisie, ?string $fichierJointMission, ?string $mandatCFA, ?string $typeContrat, ?string $dateDebutContrat, ?string $dateFinContrat, ?string $genreMaitreApprentissage, ?string $nomMaitreApprentissage, ?string $prenomMaitreApprentissage, ?string $fonctionMaitreApprentissage, ?string $telephoneMaitreApprentissage, ?string $emailMaitreApprentissage, ?string $dateNaissanceMaitreApprentissage, ?string $dejaMaitreApprentissage, ?string $dejaFormationMaitreApprentissage, ?string $genreSecondMaitreApprentissage, ?string $nomSecondMaitreApprentissage, ?string $prenomSecondMaitreApprentissage, ?string $fonctionSecondMaitreApprentissage, ?string $telephoneSecondMaitreApprentissage, ?string $emailSecondMaitreApprentissage, ?string $dateNaissanceSecondMaitreApprentissage, ?string $dejaSecondMaitreApprentissage, ?string $dejaFormationSecondMaitreApprentissage, ?string $responsableDeFormation, ?string $validateurDevis, ?string $dureeContrat, ?string $coutContrat, ?string $montantPriseEnChargeNPEC, ?string $montantResteCharge, ?string $coutFormationAnnee, ?string $coutContratAvantNegociation, ?string $numeroDECA, ?string $codeDiplome, ?string $codeRNCP, ?string $SFP, ?string $dateEnvoieSFP, ?string $gestionnaireEnvoieSFP, ?string $dureeSFP, ?string $dateDebutFormation, ?string $dateFinFormation, ?string $etablissementDocEmployeur, ?string $dateEtablissementDocEmployeur)
    {
        $this->archivee = $archivee;
        $this->gereEnDehorsDeStudea = $gereEnDehorsDeStudea;
        $this->statutsOPCO = $statutsOPCO;
        $this->id = $id;
        $this->etablissement = $etablissement;
        $this->formation = $formation;
        $this->anneeDebut = $anneeDebut;
        $this->anneeFin = $anneeFin;
        $this->genreAlternantEtu = $genreAlternantEtu;
        $this->nomAlternantEtu = $nomAlternantEtu;
        $this->prenomAlternantEtu = $prenomAlternantEtu;
        $this->DateDeSaisieParEntreprise = $DateDeSaisieParEntreprise;
        $this->validationPedagogiqueMission = $validationPedagogiqueMission;
        $this->ficheEnErreur = $ficheEnErreur;
        $this->codeErreur = $codeErreur;
        $this->contratEtConventionEnvoyeEntreprise = $contratEtConventionEnvoyeEntreprise;
        $this->contratEtOuConventionSigne = $contratEtOuConventionSigne;
        $this->dateNaissance = $dateNaissance;
        $this->communeNaissance = $communeNaissance;
        $this->paysNaissance = $paysNaissance;
        $this->nationalite = $nationalite;
        $this->travailleurHandicape = $travailleurHandicape;
        $this->titulairePermisConduire = $titulairePermisConduire;
        $this->numeroSecuriteSociale = $numeroSecuriteSociale;
        $this->pasDeNumeroSecuriteSociale = $pasDeNumeroSecuriteSociale;
        $this->sportifHautNiveau = $sportifHautNiveau;
        $this->telephone1 = $telephone1;
        $this->telephone2 = $telephone2;
        $this->email1 = $email1;
        $this->email2 = $email2;
        $this->adresse = $adresse;
        $this->complement = $complement;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->genreRepresentantLegal = $genreRepresentantLegal;
        $this->nomRepresentantLegal = $nomRepresentantLegal;
        $this->prenomRepresentantLegal = $prenomRepresentantLegal;
        $this->adresse2 = $adresse2;
        $this->complement2 = $complement2;
        $this->codePostal2 = $codePostal2;
        $this->ville2 = $ville2;
        $this->codeINE = $codeINE;
        $this->situationAvantContrat = $situationAvantContrat;
        $this->paysDernierDiplomePrepare = $paysDernierDiplomePrepare;
        $this->departementDernierDiplomePrepare = $departementDernierDiplomePrepare;
        $this->etablissementDernierDiplomePrepare = $etablissementDernierDiplomePrepare;
        $this->UAIEtablissementDernierDiplomePrepare = $UAIEtablissementDernierDiplomePrepare;
        $this->typeDiplome = $typeDiplome;
        $this->annee = $annee;
        $this->intitule = $intitule;
        $this->obtention = $obtention;
        $this->derniereAnneeOuClasseSuivie = $derniereAnneeOuClasseSuivie;
        $this->dernierDiplomeObtenue = $dernierDiplomeObtenue;
        $this->entrepriseTemporaire = $entrepriseTemporaire;
        $this->nomContactTemporaire = $nomContactTemporaire;
        $this->prenomContactTemporaire = $prenomContactTemporaire;
        $this->emailContactTemporaire = $emailContactTemporaire;
        $this->telephoneContactTemporaire = $telephoneContactTemporaire;
        $this->siret = $siret;
        $this->typeEmployeur = $typeEmployeur;
        $this->raisonSociale = $raisonSociale;
        $this->codeNAF = $codeNAF;
        $this->caisseRetraiteComplementaire = $caisseRetraiteComplementaire;
        $this->effectifTotal = $effectifTotal;
        $this->adresseContact = $adresseContact;
        $this->complementAdresseContact = $complementAdresseContact;
        $this->codePostalContact = $codePostalContact;
        $this->villeContact = $villeContact;
        $this->adresseContact2 = $adresseContact2;
        $this->complementAdresseContact2 = $complementAdresseContact2;
        $this->codePostalContact2 = $codePostalContact2;
        $this->villeContact2 = $villeContact2;
        $this->genreDuDirecteur = $genreDuDirecteur;
        $this->nomDirecteur = $nomDirecteur;
        $this->prenomDirecteur = $prenomDirecteur;
        $this->fonctionDirecteur = $fonctionDirecteur;
        $this->emailDirecteur = $emailDirecteur;
        $this->siretAdministration = $siretAdministration;
        $this->typeEmployeurDirecteur = $typeEmployeurDirecteur;
        $this->raisonSocialDirecteur = $raisonSocialDirecteur;
        $this->codeNAFDirecteur = $codeNAFDirecteur;
        $this->caisseRetraiteComplementaireDirecteur = $caisseRetraiteComplementaireDirecteur;
        $this->effectifTotalDirecteur = $effectifTotalDirecteur;
        $this->adresseDirecteur = $adresseDirecteur;
        $this->complementAdresseDirecteur = $complementAdresseDirecteur;
        $this->codePostalDirecteur = $codePostalDirecteur;
        $this->villeDirecteur = $villeDirecteur;
        $this->genreDirecteur2 = $genreDirecteur2;
        $this->nomDirecteur2 = $nomDirecteur2;
        $this->prenomDirecteur2 = $prenomDirecteur2;
        $this->fonctionDirecteur2 = $fonctionDirecteur2;
        $this->emailDirecteur2 = $emailDirecteur2;
        $this->genreInterlocuteurRH = $genreInterlocuteurRH;
        $this->nomInterlocuteurRH = $nomInterlocuteurRH;
        $this->prenomInterlocuteurRH = $prenomInterlocuteurRH;
        $this->fonctionInterlocuteurRH = $fonctionInterlocuteurRH;
        $this->emailInterlocuteurRH = $emailInterlocuteurRH;
        $this->OPCO = $OPCO;
        $this->IDCC = $IDCC;
        $this->codeIDCC = $codeIDCC;
        $this->missionSaisie = $missionSaisie;
        $this->fichierJointMission = $fichierJointMission;
        $this->mandatCFA = $mandatCFA;
        $this->typeContrat = $typeContrat;
        $this->dateDebutContrat = $dateDebutContrat;
        $this->dateFinContrat = $dateFinContrat;
        $this->genreMaitreApprentissage = $genreMaitreApprentissage;
        $this->nomMaitreApprentissage = $nomMaitreApprentissage;
        $this->prenomMaitreApprentissage = $prenomMaitreApprentissage;
        $this->fonctionMaitreApprentissage = $fonctionMaitreApprentissage;
        $this->telephoneMaitreApprentissage = $telephoneMaitreApprentissage;
        $this->emailMaitreApprentissage = $emailMaitreApprentissage;
        $this->dateNaissanceMaitreApprentissage = $dateNaissanceMaitreApprentissage;
        $this->dejaMaitreApprentissage = $dejaMaitreApprentissage;
        $this->dejaFormationMaitreApprentissage = $dejaFormationMaitreApprentissage;
        $this->genreSecondMaitreApprentissage = $genreSecondMaitreApprentissage;
        $this->nomSecondMaitreApprentissage = $nomSecondMaitreApprentissage;
        $this->prenomSecondMaitreApprentissage = $prenomSecondMaitreApprentissage;
        $this->fonctionSecondMaitreApprentissage = $fonctionSecondMaitreApprentissage;
        $this->telephoneSecondMaitreApprentissage = $telephoneSecondMaitreApprentissage;
        $this->emailSecondMaitreApprentissage = $emailSecondMaitreApprentissage;
        $this->dateNaissanceSecondMaitreApprentissage = $dateNaissanceSecondMaitreApprentissage;
        $this->dejaSecondMaitreApprentissage = $dejaSecondMaitreApprentissage;
        $this->dejaFormationSecondMaitreApprentissage = $dejaFormationSecondMaitreApprentissage;
        $this->responsableDeFormation = $responsableDeFormation;
        $this->validateurDevis = $validateurDevis;
        $this->dureeContrat = $dureeContrat;
        $this->coutContrat = $coutContrat;
        $this->montantPriseEnChargeNPEC = $montantPriseEnChargeNPEC;
        $this->montantResteCharge = $montantResteCharge;
        $this->coutFormationAnnee = $coutFormationAnnee;
        $this->coutContratAvantNegociation = $coutContratAvantNegociation;
        $this->numeroDECA = $numeroDECA;
        $this->codeDiplome = $codeDiplome;
        $this->codeRNCP = $codeRNCP;
        $this->SFP = $SFP;
        $this->dateEnvoieSFP = $dateEnvoieSFP;
        $this->gestionnaireEnvoieSFP = $gestionnaireEnvoieSFP;
        $this->dureeSFP = $dureeSFP;
        $this->dateDebutFormation = $dateDebutFormation;
        $this->dateFinFormation = $dateFinFormation;
        $this->etablissementDocEmployeur = $etablissementDocEmployeur;
        $this->dateEtablissementDocEmployeur = $dateEtablissementDocEmployeur;
    }

    public function getArchivee(): ?string
    {
        return $this->archivee;
    }

    public function getGereEnDehorsDeStudea(): ?string
    {
        return $this->gereEnDehorsDeStudea;
    }

    public function getStatutsOPCO(): ?string
    {
        return $this->statutsOPCO;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function getAnneeDebut(): ?string
    {
        return $this->anneeDebut;
    }

    public function getAnneeFin(): ?string
    {
        return $this->anneeFin;
    }

    public function getGenreAlternantEtu(): ?string
    {
        return $this->genreAlternantEtu;
    }

    public function getNomAlternantEtu(): ?string
    {
        return $this->nomAlternantEtu;
    }

    public function getPrenomAlternantEtu(): ?string
    {
        return $this->prenomAlternantEtu;
    }

    public function getDateDeSaisieParEntreprise(): ?string
    {
        return $this->DateDeSaisieParEntreprise;
    }

    public function getValidationPedagogiqueMission(): ?string
    {
        return $this->validationPedagogiqueMission;
    }

    public function getFicheEnErreur(): ?string
    {
        return $this->ficheEnErreur;
    }

    public function getCodeErreur(): ?string
    {
        return $this->codeErreur;
    }

    public function getContratEtConventionEnvoyeEntreprise(): ?string
    {
        return $this->contratEtConventionEnvoyeEntreprise;
    }

    public function getContratEtOuConventionSigne(): ?string
    {
        return $this->contratEtOuConventionSigne;
    }

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function getCommuneNaissance(): ?string
    {
        return $this->communeNaissance;
    }

    public function getPaysNaissance(): ?string
    {
        return $this->paysNaissance;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function getTravailleurHandicape(): ?string
    {
        return $this->travailleurHandicape;
    }

    public function getTitulairePermisConduire(): ?string
    {
        return $this->titulairePermisConduire;
    }

    public function getNumeroSecuriteSociale(): ?string
    {
        return $this->numeroSecuriteSociale;
    }

    public function getPasDeNumeroSecuriteSociale(): ?string
    {
        return $this->pasDeNumeroSecuriteSociale;
    }

    public function getSportifHautNiveau(): ?string
    {
        return $this->sportifHautNiveau;
    }

    public function getTelephone1(): ?string
    {
        return $this->telephone1;
    }

    public function getTelephone2(): ?string
    {
        return $this->telephone2;
    }

    public function getEmail1(): ?string
    {
        return $this->email1;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function getGenreRepresentantLegal(): ?string
    {
        return $this->genreRepresentantLegal;
    }

    public function getNomRepresentantLegal(): ?string
    {
        return $this->nomRepresentantLegal;
    }

    public function getPrenomRepresentantLegal(): ?string
    {
        return $this->prenomRepresentantLegal;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function getComplement2(): ?string
    {
        return $this->complement2;
    }

    public function getCodePostal2(): ?string
    {
        return $this->codePostal2;
    }

    public function getVille2(): ?string
    {
        return $this->ville2;
    }

    public function getCodeINE(): ?string
    {
        return $this->codeINE;
    }

    public function getSituationAvantContrat(): ?string
    {
        return $this->situationAvantContrat;
    }

    public function getPaysDernierDiplomePrepare(): ?string
    {
        return $this->paysDernierDiplomePrepare;
    }

    public function getDepartementDernierDiplomePrepare(): ?string
    {
        return $this->departementDernierDiplomePrepare;
    }

    public function getEtablissementDernierDiplomePrepare(): ?string
    {
        return $this->etablissementDernierDiplomePrepare;
    }

    public function getUAIEtablissementDernierDiplomePrepare(): ?string
    {
        return $this->UAIEtablissementDernierDiplomePrepare;
    }

    public function getTypeDiplome(): ?string
    {
        return $this->typeDiplome;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function getObtention(): ?string
    {
        return $this->obtention;
    }

    public function getDerniereAnneeOuClasseSuivie(): ?string
    {
        return $this->derniereAnneeOuClasseSuivie;
    }

    public function getDernierDiplomeObtenue(): ?string
    {
        return $this->dernierDiplomeObtenue;
    }

    public function getEntrepriseTemporaire(): ?string
    {
        return $this->entrepriseTemporaire;
    }

    public function getNomContactTemporaire(): ?string
    {
        return $this->nomContactTemporaire;
    }

    public function getPrenomContactTemporaire(): ?string
    {
        return $this->prenomContactTemporaire;
    }

    public function getEmailContactTemporaire(): ?string
    {
        return $this->emailContactTemporaire;
    }

    public function getTelephoneContactTemporaire(): ?string
    {
        return $this->telephoneContactTemporaire;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function getTypeEmployeur(): ?string
    {
        return $this->typeEmployeur;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function getCodeNAF(): ?string
    {
        return $this->codeNAF;
    }

    public function getCaisseRetraiteComplementaire(): ?string
    {
        return $this->caisseRetraiteComplementaire;
    }

    public function getEffectifTotal(): ?string
    {
        return $this->effectifTotal;
    }

    public function getAdresseContact(): ?string
    {
        return $this->adresseContact;
    }

    public function getComplementAdresseContact(): ?string
    {
        return $this->complementAdresseContact;
    }

    public function getCodePostalContact(): ?string
    {
        return $this->codePostalContact;
    }

    public function getVilleContact(): ?string
    {
        return $this->villeContact;
    }

    public function getAdresseContact2(): ?string
    {
        return $this->adresseContact2;
    }

    public function getComplementAdresseContact2(): ?string
    {
        return $this->complementAdresseContact2;
    }

    public function getCodePostalContact2(): ?string
    {
        return $this->codePostalContact2;
    }

    public function getVilleContact2(): ?string
    {
        return $this->villeContact2;
    }

    public function getGenreDuDirecteur(): ?string
    {
        return $this->genreDuDirecteur;
    }

    public function getNomDirecteur(): ?string
    {
        return $this->nomDirecteur;
    }

    public function getPrenomDirecteur(): ?string
    {
        return $this->prenomDirecteur;
    }

    public function getFonctionDirecteur(): ?string
    {
        return $this->fonctionDirecteur;
    }

    public function getEmailDirecteur(): ?string
    {
        return $this->emailDirecteur;
    }

    public function getSiretAdministration(): ?string
    {
        return $this->siretAdministration;
    }

    public function getTypeEmployeurDirecteur(): ?string
    {
        return $this->typeEmployeurDirecteur;
    }

    public function getRaisonSocialDirecteur(): ?string
    {
        return $this->raisonSocialDirecteur;
    }

    public function getCodeNAFDirecteur(): ?string
    {
        return $this->codeNAFDirecteur;
    }

    public function getCaisseRetraiteComplementaireDirecteur(): ?string
    {
        return $this->caisseRetraiteComplementaireDirecteur;
    }

    public function getEffectifTotalDirecteur(): ?string
    {
        return $this->effectifTotalDirecteur;
    }

    public function getAdresseDirecteur(): ?string
    {
        return $this->adresseDirecteur;
    }

    public function getComplementAdresseDirecteur(): ?string
    {
        return $this->complementAdresseDirecteur;
    }

    public function getCodePostalDirecteur(): ?string
    {
        return $this->codePostalDirecteur;
    }

    public function getVilleDirecteur(): ?string
    {
        return $this->villeDirecteur;
    }

    public function getGenreDirecteur2(): ?string
    {
        return $this->genreDirecteur2;
    }

    public function getNomDirecteur2(): ?string
    {
        return $this->nomDirecteur2;
    }

    public function getPrenomDirecteur2(): ?string
    {
        return $this->prenomDirecteur2;
    }

    public function getFonctionDirecteur2(): ?string
    {
        return $this->fonctionDirecteur2;
    }

    public function getEmailDirecteur2(): ?string
    {
        return $this->emailDirecteur2;
    }

    public function getGenreInterlocuteurRH(): ?string
    {
        return $this->genreInterlocuteurRH;
    }

    public function getNomInterlocuteurRH(): ?string
    {
        return $this->nomInterlocuteurRH;
    }

    public function getPrenomInterlocuteurRH(): ?string
    {
        return $this->prenomInterlocuteurRH;
    }

    public function getFonctionInterlocuteurRH(): ?string
    {
        return $this->fonctionInterlocuteurRH;
    }

    public function getEmailInterlocuteurRH(): ?string
    {
        return $this->emailInterlocuteurRH;
    }

    public function getOPCO(): ?string
    {
        return $this->OPCO;
    }

    public function getIDCC(): ?string
    {
        return $this->IDCC;
    }

    public function getCodeIDCC(): ?string
    {
        return $this->codeIDCC;
    }

    public function getMissionSaisie(): ?string
    {
        return $this->missionSaisie;
    }

    public function getFichierJointMission(): ?string
    {
        return $this->fichierJointMission;
    }

    public function getMandatCFA(): ?string
    {
        return $this->mandatCFA;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function getDateDebutContrat(): ?string
    {
        return $this->dateDebutContrat;
    }

    public function getDateFinContrat(): ?string
    {
        return $this->dateFinContrat;
    }

    public function getGenreMaitreApprentissage(): ?string
    {
        return $this->genreMaitreApprentissage;
    }

    public function getNomMaitreApprentissage(): ?string
    {
        return $this->nomMaitreApprentissage;
    }

    public function getPrenomMaitreApprentissage(): ?string
    {
        return $this->prenomMaitreApprentissage;
    }

    public function getFonctionMaitreApprentissage(): ?string
    {
        return $this->fonctionMaitreApprentissage;
    }

    public function getTelephoneMaitreApprentissage(): ?string
    {
        return $this->telephoneMaitreApprentissage;
    }

    public function getEmailMaitreApprentissage(): ?string
    {
        return $this->emailMaitreApprentissage;
    }

    public function getDateNaissanceMaitreApprentissage(): ?string
    {
        return $this->dateNaissanceMaitreApprentissage;
    }

    public function getDejaMaitreApprentissage(): ?string
    {
        return $this->dejaMaitreApprentissage;
    }

    public function getDejaFormationMaitreApprentissage(): ?string
    {
        return $this->dejaFormationMaitreApprentissage;
    }

    public function getGenreSecondMaitreApprentissage(): ?string
    {
        return $this->genreSecondMaitreApprentissage;
    }

    public function getNomSecondMaitreApprentissage(): ?string
    {
        return $this->nomSecondMaitreApprentissage;
    }

    public function getPrenomSecondMaitreApprentissage(): ?string
    {
        return $this->prenomSecondMaitreApprentissage;
    }

    public function getFonctionSecondMaitreApprentissage(): ?string
    {
        return $this->fonctionSecondMaitreApprentissage;
    }

    public function getTelephoneSecondMaitreApprentissage(): ?string
    {
        return $this->telephoneSecondMaitreApprentissage;
    }

    public function getEmailSecondMaitreApprentissage(): ?string
    {
        return $this->emailSecondMaitreApprentissage;
    }

    public function getDateNaissanceSecondMaitreApprentissage(): ?string
    {
        return $this->dateNaissanceSecondMaitreApprentissage;
    }

    public function getDejaSecondMaitreApprentissage(): ?string
    {
        return $this->dejaSecondMaitreApprentissage;
    }

    public function getDejaFormationSecondMaitreApprentissage(): ?string
    {
        return $this->dejaFormationSecondMaitreApprentissage;
    }

    public function getResponsableDeFormation(): ?string
    {
        return $this->responsableDeFormation;
    }

    public function getValidateurDevis(): ?string
    {
        return $this->validateurDevis;
    }

    public function getDureeContrat(): ?string
    {
        return $this->dureeContrat;
    }

    public function getCoutContrat(): ?string
    {
        return $this->coutContrat;
    }

    public function getMontantPriseEnChargeNPEC(): ?string
    {
        return $this->montantPriseEnChargeNPEC;
    }

    public function getMontantResteCharge(): ?string
    {
        return $this->montantResteCharge;
    }

    public function getCoutFormationAnnee(): ?string
    {
        return $this->coutFormationAnnee;
    }

    public function getCoutContratAvantNegociation(): ?string
    {
        return $this->coutContratAvantNegociation;
    }

    public function getNumeroDECA(): ?string
    {
        return $this->numeroDECA;
    }

    public function getCodeDiplome(): ?string
    {
        return $this->codeDiplome;
    }

    public function getCodeRNCP(): ?string
    {
        return $this->codeRNCP;
    }

    public function getSFP(): ?string
    {
        return $this->SFP;
    }

    public function getDateEnvoieSFP(): ?string
    {
        return $this->dateEnvoieSFP;
    }

    public function getGestionnaireEnvoieSFP(): ?string
    {
        return $this->gestionnaireEnvoieSFP;
    }

    public function getDureeSFP(): ?string
    {
        return $this->dureeSFP;
    }

    public function getDateDebutFormation(): ?string
    {
        return $this->dateDebutFormation;
    }

    public function getDateFinFormation(): ?string
    {
        return $this->dateFinFormation;
    }

    public function getEtablissementDocEmployeur(): ?string
    {
        return $this->etablissementDocEmployeur;
    }

    public function getDateEtablissementDocEmployeur(): ?string
    {
        return $this->dateEtablissementDocEmployeur;
    }

    public function formatTableau(): array
    {
        return array("archivee" => $this->getArchivee(),
            "gereEnDehorsDeStudea" => $this->getGereEnDehorsDeStudea(),
            "statutsOPCO" => $this->getStatutsOPCO(),
            "id" => $this->getId(),
            "etablissement" => $this->getEtablissement(),
            "formation" => $this->getFormation(),
            "anneeDebut" => $this->getAnneeDebut(),
            "anneeFin" => $this->getAnneeFin(),
            "genreAlternantEtu" => $this->getGenreAlternantEtu(),
            "nomAlternantEtu" => $this->getNomAlternantEtu(),
            "prenomAlternantEtu" => $this->getPrenomAlternantEtu(),
            "DateDeSaisieParEntreprise" => $this->getDateDeSaisieParEntreprise(),
            "validationPedagogiqueMission" => $this->getValidationPedagogiqueMission(),
            "ficheEnErreur" => $this->getFicheEnErreur(),
            "codeErreur" => $this->getCodeErreur(),
            "contratEtConventionEnvoyeEntreprise" => $this->getContratEtConventionEnvoyeEntreprise(),
            "contratEtOuConventionSigne" => $this->getContratEtOuConventionSigne(),
            "dateNaissance" => $this->getDateNaissance(),
            "communeNaissance" => $this->getCommuneNaissance(),
            "paysNaissance" => $this->getPaysNaissance(),
            "nationalite" => $this->getNationalite(),
            "travailleurHandicape" => $this->getTravailleurHandicape(),
            "titulairePermisConduire" => $this->getTitulairePermisConduire(),
            "numeroSecuriteSociale" => $this->getNumeroSecuriteSociale(),
            "pasDeNumeroSecuriteSociale" => $this->getPasDeNumeroSecuriteSociale(),
            "sportifHautNiveau" => $this->getSportifHautNiveau(),
            "telephone1" => $this->getTelephone1(),
            "telephone2" => $this->getTelephone2(),
            "email1" => $this->getEmail1(),
            "email2" => $this->getEmail2(),
            "adresse" => $this->getAdresse(),
            "complement" => $this->getComplement(),
            "codePostal" => $this->getCodePostal(),
            "ville" => $this->getVille(),
            "genreRepresentantLegal" => $this->getGenreRepresentantLegal(),
            "nomRepresentantLegal" => $this->getNomRepresentantLegal(),
            "prenomRepresentantLegal" => $this->getPrenomRepresentantLegal(),
            "adresse2" => $this->getAdresse2(),
            "complement2" => $this->getComplement2(),
            "codePostal2" => $this->getCodePostal2(),
            "ville2" => $this->getVille2(),
            "codeINE" => $this->getCodeINE(),
            "situationAvantContrat" => $this->getSituationAvantContrat(),
            "paysDernierDiplomePrepare" => $this->getPaysDernierDiplomePrepare(),
            "departementDernierDiplomePrepare" => $this->getDepartementDernierDiplomePrepare(),
            "etablissementDernierDiplomePrepare" => $this->getEtablissementDernierDiplomePrepare(),
            "UAIEtablissementDernierDiplomePrepare" => $this->getUAIEtablissementDernierDiplomePrepare(),
            "typeDiplome" => $this->getTypeDiplome(),
            "annee" => $this->getAnnee(),
            "intitule" => $this->getIntitule(),
            "obtention" => $this->getObtention(),
            "derniereAnneeOuClasseSuivie" => $this->getDerniereAnneeOuClasseSuivie(),
            "dernierDiplomeObtenue" => $this->getDernierDiplomeObtenue(),
            "entrepriseTemporaire" => $this->getEntrepriseTemporaire(),
            "nomContactTemporaire" => $this->getNomContactTemporaire(),
            "prenomContactTemporaire" => $this->getPrenomContactTemporaire(),
            "emailContactTemporaire" => $this->getEmailContactTemporaire(),
            "telephoneContactTemporaire" => $this->getTelephoneContactTemporaire(),
            "siret" => $this->getSiret(),
            "typeEmployeur" => $this->getTypeEmployeur(),
            "raisonSociale" => $this->getRaisonSociale(),
            "codeNAF" => $this->getCodeNAF(),
            "caisseRetraiteComplementaire" => $this->getCaisseRetraiteComplementaire(),
            "effectifTotal" => $this->getEffectifTotal(),
            "adresseContact" => $this->getAdresseContact(),
            "complementAdresseContact" => $this->getComplementAdresseContact(),
            "codePostalContact" => $this->getCodePostalContact(),
            "villeContact" => $this->getVilleContact(),
            "adresseContact2" => $this->getAdresseContact2(),
            "complementAdresseContact2" => $this->getComplementAdresseContact2(),
            "codePostalContact2" => $this->getCodePostalContact2(),
            "villeContact2" => $this->getVilleContact2(),
            "genreDuDirecteur" => $this->getGenreDuDirecteur(),
            "nomDirecteur" => $this->getNomDirecteur(),
            "prenomDirecteur" => $this->getPrenomDirecteur(),
            "fonctionDirecteur" => $this->getFonctionDirecteur(),
            "emailDirecteur" => $this->getEmailDirecteur(),
            "siretAdministration" => $this->getSiretAdministration(),
            "typeEmployeurDirecteur" => $this->getTypeEmployeurDirecteur(),
            "raisonSocialDirecteur" => $this->getRaisonSocialDirecteur(),
            "codeNAFDirecteur" => $this->getCodeNAFDirecteur(),
            "caisseRetraiteComplementaireDirecteur" => $this->getCaisseRetraiteComplementaireDirecteur(),
            "effectifTotalDirecteur" => $this->getEffectifTotalDirecteur(),
            "adresseDirecteur" => $this->getAdresseDirecteur(),
            "complementAdresseDirecteur" => $this->getComplementAdresseDirecteur(),
            "codePostalDirecteur" => $this->getCodePostalDirecteur(),
            "villeDirecteur" => $this->getVilleDirecteur(),
            "genreDirecteur2" => $this->getGenreDirecteur2(),
            "nomDirecteur2" => $this->getNomDirecteur2(),
            "prenomDirecteur2" => $this->getPrenomDirecteur2(),
            "fonctionDirecteur2" => $this->getFonctionDirecteur2(),
            "emailDirecteur2" => $this->getEmailDirecteur2(),
            "genreInterlocuteurRH" => $this->getGenreInterlocuteurRH(),
            "nomInterlocuteurRH" => $this->getNomInterlocuteurRH(),
            "prenomInterlocuteurRH" => $this->getPrenomInterlocuteurRH(),
            "fonctionInterlocuteurRH" => $this->getFonctionInterlocuteurRH(),
            "emailInterlocuteurRH" => $this->getEmailInterlocuteurRH(),
            "OPCO" => $this->getOPCO(),
            "IDCC" => $this->getIDCC(),
            "codeIDCC" => $this->getCodeIDCC(),
            "missionSaisie" => $this->getMissionSaisie(),
            "fichierJointMission" => $this->getFichierJointMission(),
            "mandatCFA" => $this->getMandatCFA(),
            "typeContrat" => $this->getTypeContrat(),
            "dateDebutContrat" => $this->getDateDebutContrat(),
            "dateFinContrat" => $this->getDateFinContrat(),
            "genreMaitreApprentissage" => $this->getGenreMaitreApprentissage(),
            "nomMaitreApprentissage" => $this->getNomMaitreApprentissage(),
            "prenomMaitreApprentissage" => $this->getPrenomMaitreApprentissage(),
            "fonctionMaitreApprentissage" => $this->getFonctionMaitreApprentissage(),
            "telephoneMaitreApprentissage" => $this->getTelephoneMaitreApprentissage(),
            "emailMaitreApprentissage" => $this->getEmailMaitreApprentissage(),
            "dateNaissanceMaitreApprentissage" => $this->getDateNaissanceMaitreApprentissage(),
            "dejaMaitreApprentissage" => $this->getDejaMaitreApprentissage(),
            "dejaFormationMaitreApprentissage" => $this->getDejaFormationMaitreApprentissage(),
            "genreSecondMaitreApprentissage" => $this->getGenreSecondMaitreApprentissage(),
            "nomSecondMaitreApprentissage" => $this->getNomSecondMaitreApprentissage(),
            "prenomSecondMaitreApprentissage" => $this->getPrenomSecondMaitreApprentissage(),
            "fonctionSecondMaitreApprentissage" => $this->getFonctionSecondMaitreApprentissage(),
            "telephoneSecondMaitreApprentissage" => $this->getTelephoneSecondMaitreApprentissage(),
            "emailSecondMaitreApprentissage" => $this->getEmailSecondMaitreApprentissage(),
            "dateNaissanceSecondMaitreApprentissage" => $this->getDateNaissanceSecondMaitreApprentissage(),
            "dejaSecondMaitreApprentissage" => $this->getDejaSecondMaitreApprentissage(),
            "dejaFormationSecondMaitreApprentissage" => $this->getDejaFormationSecondMaitreApprentissage(),
            "responsableDeFormation" => $this->getResponsableDeFormation(),
            "validateurDevis" => $this->getValidateurDevis(),
            "dureeContrat" => $this->getDureeContrat(),
            "coutContrat" => $this->getCoutContrat(),
            "montantPriseEnChargeNPEC" => $this->getMontantPriseEnChargeNPEC(),
            "montantResteCharge" => $this->getMontantResteCharge(),
            "coutFormationAnnee" => $this->getCoutFormationAnnee(),
            "coutContratAvantNegociation" => $this->getCoutContratAvantNegociation(),
            "numeroDECA" => $this->getNumeroDECA(),
            "codeDiplome" => $this->getCodeDiplome(),
            "codeRNCP" => $this->getCodeRNCP(),
            "SFP" => $this->getSFP(),
            "dateEnvoieSFP" => $this->getDateEnvoieSFP(),
            "gestionnaireEnvoieSFP" => $this->getGestionnaireEnvoieSFP(),
            "dureeSFP" => $this->getDureeSFP(),
            "dateDebutFormation" => $this->getDateDebutFormation(),
            "dateFinFormation" => $this->getDateFinFormation(),
            "etablissementDocEmployeur" => $this->getEtablissementDocEmployeur(),
            "dateEtablissementDocEmployeur" => $this->getDateEtablissementDocEmployeur());
    }


}