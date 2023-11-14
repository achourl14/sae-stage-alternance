<?php

namespace App\Modele\DataObject;

class ConventionStage extends AbstractDataObject
{
    private int $numConvention;
    private int $numEtudiant;
    private string $nomEtu;
    private string $prenomEtu;
    private string $numTelPersoEtu;
    private string $numTelEtu;
    private string $mailPersoEtu;
    private string $mailUniversitaireEtu;
    private string $codeUfr;
    private string $libUfr;
    private string $codeDepartement;
    private string $codeEtape;
    private string $libEtape;
    private string $dateDebut;
    private string $dateFin;
    private int $interruption;
    private string $dateDebutInterruption;
    private string $dateFinInterruption;
    private string $thematique;
    private string $sujet;
    private string $fonctionTache;
    private string $detailProjet;
    private string $duree;
    private int $nbJourTravail;
    private int $nbHeureHebdomadairer;
    private float $gratification;
    private string $uniteGratification;
    private string $uniteDureGratification;
    private string $conventionValide;
    private string $nomEnseignantReferent;
    private string $prenomEnseignentReferent;
    private string $mailEnseignentReferent;
    private string $nomSignataire;
    private string $prenomSignataire;
    private string $mailSignataire;
    private string $fonctionSignataire;
    private string $anneeUniversitaire;
    private string $typeDeConvention;
    private string $commentaireStage;
    private string $commentaireDureeTravail;
    private int $codeELP;
    private string $elementPedagogique;
    private string $codeSexeEtu;
    private string $avantageNature;
    private string $adresseEtu;
    private int $codePostalEtu;
    private string $paysEtu;
    private string $villeEtu;
    private string $conventionValidePedagogique;
    private string $avenant;
    private string $detailAvenant;
    private string $dateCreationConvention;
    private string $dateModificationConvention;
    private string $origineStage;
    private string $nomEtablissement;
    private int $siret;
    private string $adresseResidence;
    private string $adresseVoie;
    private string $adresseLibCedex;
    private int $codePostal;
    private string $communeEtabAcceuil;
    private string $paysEtablissement;
    private string $statutJuridique;
    private string $typeStructure;
    private string $effectif;
    private string $codeNAF;
    private string $telEtablissement;
    private string $fax;
    private string $mailEtablissement;
    private string $siteWeb;
    private string $nomServiceAcceuil;
    private string $residenceServiceAcceuil;
    private string $voieServiceAcceuil;
    private string $cedexServiceAcceuil;
    private int $codePostalServiceAcceuil;
    private string $communeServiceAcceuil;
    private string $paysServiceAcceuil;
    private string $nomTuteurProfessionnel;
    private string $prenomTuteurProfessionnel;
    private string $mailTuteurProfessionnel;
    private string $telTuteurProfessionnel;
    private string $fonctionTuteurProfessionnel;

    /**
     * @param int $numConvention
     * @param int $numEtudiant
     * @param string $nomEtu
     * @param string $prenomEtu
     * @param string $numTelPersoEtu
     * @param string $numTelEtu
     * @param string $mailPersoEtu
     * @param string $mailUniversitaireEtu
     * @param string $codeUfr
     * @param string $libUfr
     * @param string $codeDepartement
     * @param string $codeEtape
     * @param string $libEtape
     * @param string $dateDebut
     * @param string $dateFin
     * @param int $interruption
     * @param string $dateDebutInterruption
     * @param string $dateFinInterruption
     * @param string $thematique
     * @param string $sujet
     * @param string $fonctionTache
     * @param string $detailProjet
     * @param string $duree
     * @param int $nbJourTravail
     * @param int $nbHeureHebdomadairer
     * @param float $gratification
     * @param string $uniteGratification
     * @param string $uniteDureGratification
     * @param string $conventionValide
     * @param string $nomEnseignantReferent
     * @param string $prenomEnseignentReferent
     * @param string $mailEnseignentReferent
     * @param string $nomSignataire
     * @param string $prenomSignataire
     * @param string $mailSignataire
     * @param string $fonctionSignataire
     * @param string $anneeUniversitaire
     * @param string $typeDeConvention
     * @param string $commentaireStage
     * @param string $commentaireDureeTravail
     * @param int $codeELP
     * @param string $elementPedagogique
     * @param string $codeSexeEtu
     * @param string $avantageNature
     * @param string $adresseEtu
     * @param int $codePostalEtu
     * @param string $paysEtu
     * @param string $villeEtu
     * @param string $conventionValidePedagogique
     * @param string $avenant
     * @param string $detailAvenant
     * @param string $dateCreationConvention
     * @param string $dateModificationConvention
     * @param string $origineStage
     * @param string $nomEtablissement
     * @param int $siret
     * @param string $adresseResidence
     * @param string $adresseVoie
     * @param string $adresseLibCedex
     * @param int $codePostal
     * @param string $communeEtabAcceuil
     * @param string $paysEtablissement
     * @param string $statutJuridique
     * @param string $typeStructure
     * @param string $effectif
     * @param string $codeNAF
     * @param string $telEtablissement
     * @param string $fax
     * @param stirng $mailEtablissement
     * @param string $siteWeb
     * @param string $nomServiceAcceuil
     * @param string $residenceServiceAcceuil
     * @param string $voieServiceAcceuil
     * @param string $cedexServiceAcceuil
     * @param int $codePostalServiceAcceuil
     * @param string $communeServiceAcceuil
     * @param string $paysServiceAcceuil
     * @param string $nomTuteurProfessionnel
     * @param string $prenomTuteurProfessionnel
     * @param string $mailTuteurProfessionnel
     * @param string $telTuteurProfessionnel
     * @param string $fonctionTuteurProfessionnel
     */
    public function __construct(int $numConvention, int $numEtudiant, string $nomEtu, string $prenomEtu, string $numTelPersoEtu, string $numTelEtu, string $mailPersoEtu, string $mailUniversitaireEtu, string $codeUfr, string $libUfr, string $codeDepartement, string $codeEtape, string $libEtape, string $dateDebut, string $dateFin, int $interruption, string $dateDebutInterruption, string $dateFinInterruption, string $thematique, string $sujet, string $fonctionTache, string $detailProjet, string $duree, int $nbJourTravail, int $nbHeureHebdomadairer, float $gratification, string $uniteGratification, string $uniteDureGratification, string $conventionValide, string $nomEnseignantReferent, string $prenomEnseignentReferent, string $mailEnseignentReferent, string $nomSignataire, string $prenomSignataire, string $mailSignataire, string $fonctionSignataire, string $anneeUniversitaire, string $typeDeConvention, string $commentaireStage, string $commentaireDureeTravail, int $codeELP, string $elementPedagogique, string $codeSexeEtu, string $avantageNature, string $adresseEtu, int $codePostalEtu, string $paysEtu, string $villeEtu, string $conventionValidePedagogique, string $avenant, string $detailAvenant, string $dateCreationConvention, string $dateModificationConvention, string $origineStage, string $nomEtablissement, int $siret, string $adresseResidence, string $adresseVoie, string $adresseLibCedex, int $codePostal, string $communeEtabAcceuil, string $paysEtablissement, string $statutJuridique, string $typeStructure, string $effectif, string $codeNAF, string $telEtablissement, string $fax, string $mailEtablissement, string $siteWeb, string $nomServiceAcceuil, string $residenceServiceAcceuil, string $voieServiceAcceuil, string $cedexServiceAcceuil, int $codePostalServiceAcceuil, string $communeServiceAcceuil, string $paysServiceAcceuil, string $nomTuteurProfessionnel, string $prenomTuteurProfessionnel, string $mailTuteurProfessionnel, string $telTuteurProfessionnel, string $fonctionTuteurProfessionnel)
    {
        $this->numConvention = $numConvention;
        $this->numEtudiant = $numEtudiant;
        $this->nomEtu = $nomEtu;
        $this->prenomEtu = $prenomEtu;
        $this->numTelPersoEtu = $numTelPersoEtu;
        $this->numTelEtu = $numTelEtu;
        $this->mailPersoEtu = $mailPersoEtu;
        $this->mailUniversitaireEtu = $mailUniversitaireEtu;
        $this->codeUfr = $codeUfr;
        $this->libUfr = $libUfr;
        $this->codeDepartement = $codeDepartement;
        $this->codeEtape = $codeEtape;
        $this->libEtape = $libEtape;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->interruption = $interruption;
        $this->dateDebutInterruption = $dateDebutInterruption;
        $this->dateFinInterruption = $dateFinInterruption;
        $this->thematique = $thematique;
        $this->sujet = $sujet;
        $this->fonctionTache = $fonctionTache;
        $this->detailProjet = $detailProjet;
        $this->duree = $duree;
        $this->nbJourTravail = $nbJourTravail;
        $this->nbHeureHebdomadairer = $nbHeureHebdomadairer;
        $this->gratification = $gratification;
        $this->uniteGratification = $uniteGratification;
        $this->uniteDureGratification = $uniteDureGratification;
        $this->conventionValide = $conventionValide;
        $this->nomEnseignantReferent = $nomEnseignantReferent;
        $this->prenomEnseignentReferent = $prenomEnseignentReferent;
        $this->mailEnseignentReferent = $mailEnseignentReferent;
        $this->nomSignataire = $nomSignataire;
        $this->prenomSignataire = $prenomSignataire;
        $this->mailSignataire = $mailSignataire;
        $this->fonctionSignataire = $fonctionSignataire;
        $this->anneeUniversitaire = $anneeUniversitaire;
        $this->typeDeConvention = $typeDeConvention;
        $this->commentaireStage = $commentaireStage;
        $this->commentaireDureeTravail = $commentaireDureeTravail;
        $this->codeELP = $codeELP;
        $this->elementPedagogique = $elementPedagogique;
        $this->codeSexeEtu = $codeSexeEtu;
        $this->avantageNature = $avantageNature;
        $this->adresseEtu = $adresseEtu;
        $this->codePostalEtu = $codePostalEtu;
        $this->paysEtu = $paysEtu;
        $this->villeEtu = $villeEtu;
        $this->conventionValidePedagogique = $conventionValidePedagogique;
        $this->avenant = $avenant;
        $this->detailAvenant = $detailAvenant;
        $this->dateCreationConvention = $dateCreationConvention;
        $this->dateModificationConvention = $dateModificationConvention;
        $this->origineStage = $origineStage;
        $this->nomEtablissement = $nomEtablissement;
        $this->siret = $siret;
        $this->adresseResidence = $adresseResidence;
        $this->adresseVoie = $adresseVoie;
        $this->adresseLibCedex = $adresseLibCedex;
        $this->codePostal = $codePostal;
        $this->communeEtabAcceuil = $communeEtabAcceuil;
        $this->paysEtablissement = $paysEtablissement;
        $this->statutJuridique = $statutJuridique;
        $this->typeStructure = $typeStructure;
        $this->effectif = $effectif;
        $this->codeNAF = $codeNAF;
        $this->telEtablissement = $telEtablissement;
        $this->fax = $fax;
        $this->mailEtablissement = $mailEtablissement;
        $this->siteWeb = $siteWeb;
        $this->nomServiceAcceuil = $nomServiceAcceuil;
        $this->residenceServiceAcceuil = $residenceServiceAcceuil;
        $this->voieServiceAcceuil = $voieServiceAcceuil;
        $this->cedexServiceAcceuil = $cedexServiceAcceuil;
        $this->codePostalServiceAcceuil = $codePostalServiceAcceuil;
        $this->communeServiceAcceuil = $communeServiceAcceuil;
        $this->paysServiceAcceuil = $paysServiceAcceuil;
        $this->nomTuteurProfessionnel = $nomTuteurProfessionnel;
        $this->prenomTuteurProfessionnel = $prenomTuteurProfessionnel;
        $this->mailTuteurProfessionnel = $mailTuteurProfessionnel;
        $this->telTuteurProfessionnel = $telTuteurProfessionnel;
        $this->fonctionTuteurProfessionnel = $fonctionTuteurProfessionnel;
    }

    public function formatTableau(): array
    {
        // TODO: Implement formatTableau() method.
    }


}