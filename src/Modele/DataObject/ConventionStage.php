<?php

namespace App\Modele\DataObject;

class ConventionStage extends AbstractDataObject
{
    private int|null $numConvention;
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
    private string $interruption;
    private string|null $dateDebutInterruption;
    private string|null $dateFinInterruption;
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
     * @param string $mailEtablissement
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
    public function __construct(int|null $numConvention, int $numEtudiant, string $nomEtu, string $prenomEtu, string $numTelPersoEtu, string $numTelEtu, string $mailPersoEtu, string $mailUniversitaireEtu, string $codeUfr, string $libUfr, string $codeDepartement, string $codeEtape, string $libEtape, string $dateDebut, string $dateFin, string $interruption, string|null $dateDebutInterruption, string|null $dateFinInterruption, string $thematique, string $sujet, string $fonctionTache, string $detailProjet, string $duree, int $nbJourTravail, int $nbHeureHebdomadairer, float $gratification, string $uniteGratification, string $uniteDureGratification, string $conventionValide, string $nomEnseignantReferent, string $prenomEnseignentReferent, string $mailEnseignentReferent, string $nomSignataire, string $prenomSignataire, string $mailSignataire, string $fonctionSignataire, string $anneeUniversitaire, string $typeDeConvention, string $commentaireStage, string $commentaireDureeTravail, int $codeELP, string $elementPedagogique, string $codeSexeEtu, string $avantageNature, string $adresseEtu, int $codePostalEtu, string $paysEtu, string $villeEtu, string $conventionValidePedagogique, string $avenant, string $detailAvenant, string $dateCreationConvention, string $dateModificationConvention, string $origineStage, string $nomEtablissement, int $siret, string $adresseResidence, string $adresseVoie, string $adresseLibCedex, int $codePostal, string $communeEtabAcceuil, string $paysEtablissement, string $statutJuridique, string $typeStructure, string $effectif, string $codeNAF, string $telEtablissement, string $fax, string $mailEtablissement, string $siteWeb, string $nomServiceAcceuil, string $residenceServiceAcceuil, string $voieServiceAcceuil, string $cedexServiceAcceuil, int $codePostalServiceAcceuil, string $communeServiceAcceuil, string $paysServiceAcceuil, string $nomTuteurProfessionnel, string $prenomTuteurProfessionnel, string $mailTuteurProfessionnel, string $telTuteurProfessionnel, string $fonctionTuteurProfessionnel)
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

    public function getNumConvention()
    {
        return $this->numConvention;
    }

    public function getNumEtudiant(): int
    {
        return $this->numEtudiant;
    }

    public function getNomEtu(): string
    {
        return $this->nomEtu;
    }

    public function getPrenomEtu(): string
    {
        return $this->prenomEtu;
    }

    public function getNumTelPersoEtu(): string
    {
        return $this->numTelPersoEtu;
    }

    public function getNumTelEtu(): string
    {
        return $this->numTelEtu;
    }

    public function getMailPersoEtu(): string
    {
        return $this->mailPersoEtu;
    }

    public function getMailUniversitaireEtu(): string
    {
        return $this->mailUniversitaireEtu;
    }

    public function getCodeUfr(): string
    {
        return $this->codeUfr;
    }

    public function getLibUfr(): string
    {
        return $this->libUfr;
    }

    public function getCodeDepartement(): string
    {
        return $this->codeDepartement;
    }

    public function getCodeEtape(): string
    {
        return $this->codeEtape;
    }

    public function getLibEtape(): string
    {
        return $this->libEtape;
    }

    public function getDateDebut(): string
    {
        return $this->dateDebut;
    }

    public function getDateFin(): string
    {
        return $this->dateFin;
    }

    public function getInterruption(): string
    {
        return $this->interruption;
    }

    public function getDateDebutInterruption()
    {
        return $this->dateDebutInterruption;
    }

    public function getDateFinInterruption()
    {
        return $this->dateFinInterruption;
    }

    public function getThematique(): string
    {
        return $this->thematique;
    }

    public function getSujet(): string
    {
        return $this->sujet;
    }

    public function getFonctionTache(): string
    {
        return $this->fonctionTache;
    }

    public function getDetailProjet(): string
    {
        return $this->detailProjet;
    }

    public function getDuree(): string
    {
        return $this->duree;
    }

    public function getNbJourTravail(): int
    {
        return $this->nbJourTravail;
    }

    public function getNbHeureHebdomadairer(): int
    {
        return $this->nbHeureHebdomadairer;
    }

    public function getGratification(): float
    {
        return $this->gratification;
    }

    public function getUniteGratification(): string
    {
        return $this->uniteGratification;
    }

    public function getUniteDureGratification(): string
    {
        return $this->uniteDureGratification;
    }

    public function getConventionValide(): string
    {
        return $this->conventionValide;
    }

    public function getNomEnseignantReferent(): string
    {
        return $this->nomEnseignantReferent;
    }

    public function getPrenomEnseignentReferent(): string
    {
        return $this->prenomEnseignentReferent;
    }

    public function getMailEnseignentReferent(): string
    {
        return $this->mailEnseignentReferent;
    }

    public function getNomSignataire(): string
    {
        return $this->nomSignataire;
    }

    public function getPrenomSignataire(): string
    {
        return $this->prenomSignataire;
    }

    public function getMailSignataire(): string
    {
        return $this->mailSignataire;
    }

    public function getFonctionSignataire(): string
    {
        return $this->fonctionSignataire;
    }

    public function getAnneeUniversitaire(): string
    {
        return $this->anneeUniversitaire;
    }

    public function getTypeDeConvention(): string
    {
        return $this->typeDeConvention;
    }

    public function getCommentaireStage(): string
    {
        return $this->commentaireStage;
    }

    public function getCommentaireDureeTravail(): string
    {
        return $this->commentaireDureeTravail;
    }

    public function getCodeELP(): int
    {
        return $this->codeELP;
    }

    public function getElementPedagogique(): string
    {
        return $this->elementPedagogique;
    }

    public function getCodeSexeEtu(): string
    {
        return $this->codeSexeEtu;
    }

    public function getAvantageNature(): string
    {
        return $this->avantageNature;
    }

    public function getAdresseEtu(): string
    {
        return $this->adresseEtu;
    }

    public function getCodePostalEtu(): int
    {
        return $this->codePostalEtu;
    }

    public function getPaysEtu(): string
    {
        return $this->paysEtu;
    }

    public function getVilleEtu(): string
    {
        return $this->villeEtu;
    }

    public function getConventionValidePedagogique(): string
    {
        return $this->conventionValidePedagogique;
    }

    public function getAvenant(): string
    {
        return $this->avenant;
    }

    public function getDetailAvenant(): string
    {
        return $this->detailAvenant;
    }

    public function getDateCreationConvention(): string
    {
        return $this->dateCreationConvention;
    }

    public function getDateModificationConvention(): string
    {
        return $this->dateModificationConvention;
    }

    public function getOrigineStage(): string
    {
        return $this->origineStage;
    }

    public function getNomEtablissement(): string
    {
        return $this->nomEtablissement;
    }

    public function getSiret(): int
    {
        return $this->siret;
    }

    public function getAdresseResidence(): string
    {
        return $this->adresseResidence;
    }

    public function getAdresseVoie(): string
    {
        return $this->adresseVoie;
    }

    public function getAdresseLibCedex(): string
    {
        return $this->adresseLibCedex;
    }

    public function getCodePostal(): int
    {
        return $this->codePostal;
    }

    public function getCommuneEtabAcceuil(): string
    {
        return $this->communeEtabAcceuil;
    }

    public function getPaysEtablissement(): string
    {
        return $this->paysEtablissement;
    }

    public function getStatutJuridique(): string
    {
        return $this->statutJuridique;
    }

    public function getTypeStructure(): string
    {
        return $this->typeStructure;
    }

    public function getEffectif(): string
    {
        return $this->effectif;
    }

    public function getCodeNAF(): string
    {
        return $this->codeNAF;
    }

    public function getTelEtablissement(): string
    {
        return $this->telEtablissement;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function getMailEtablissement(): string
    {
        return $this->mailEtablissement;
    }

    public function getSiteWeb(): string
    {
        return $this->siteWeb;
    }

    public function getNomServiceAcceuil(): string
    {
        return $this->nomServiceAcceuil;
    }

    public function getResidenceServiceAcceuil(): string
    {
        return $this->residenceServiceAcceuil;
    }

    public function getVoieServiceAcceuil(): string
    {
        return $this->voieServiceAcceuil;
    }

    public function getCedexServiceAcceuil(): string
    {
        return $this->cedexServiceAcceuil;
    }

    public function getCodePostalServiceAcceuil(): int
    {
        return $this->codePostalServiceAcceuil;
    }

    public function getCommuneServiceAcceuil(): string
    {
        return $this->communeServiceAcceuil;
    }

    public function getPaysServiceAcceuil(): string
    {
        return $this->paysServiceAcceuil;
    }

    public function getNomTuteurProfessionnel(): string
    {
        return $this->nomTuteurProfessionnel;
    }

    public function getPrenomTuteurProfessionnel(): string
    {
        return $this->prenomTuteurProfessionnel;
    }

    public function getMailTuteurProfessionnel(): string
    {
        return $this->mailTuteurProfessionnel;
    }

    public function getTelTuteurProfessionnel(): string
    {
        return $this->telTuteurProfessionnel;
    }

    public function getFonctionTuteurProfessionnel(): string
    {
        return $this->fonctionTuteurProfessionnel;
    }


    public function formatTableau(): array
    {
        return array(
            "numConventionTag" => $this->getNumConvention(),
            "numEtudiantTag" => $this->getNumEtudiant(),
            "nomEtuTag" => $this->getNomEtu(),
            "prenomEtuTag" => $this->getPrenomEtu(),
            "numTelPersoEtuTag" => $this->getNumTelPersoEtu(),
            "numTelEtuTag" => $this->getNumTelEtu(),
            "mailPersoEtuTag" => $this->getMailPersoEtu(),
            "mailUniversitaireEtuTag" => $this->getMailUniversitaireEtu(),
            "codeUfrTag" => $this->getCodeUfr(),
            "libUfrTag" => $this->getLibUfr(),
            "codeDepartementTag" => $this->getCodeDepartement(),
            "codeEtapeTag" => $this->getCodeEtape(),
            "libEtapeTag" => $this->getLibEtape(),
            "dateDebutTag" => $this->getDateDebut(),
            "dateFinTag" => $this->getDateFin(),
            "interruptionTag" => $this->getInterruption(),
            "dateDebutInterruptionTag" => $this->getDateDebutInterruption(),
            "dateFinInterruptionTag" => $this->getDateFinInterruption(),
            "thematiqueTag" => $this->getThematique(),
            "sujetTag" => $this->getSujet(),
            "fonctionTacheTag" => $this->getFonctionTache(),
            "detailProjetTag" => $this->getDetailProjet(),
            "dureeTag" => $this->getDuree(),
            "nbJourTravailTag" => $this->getNbJourTravail(),
            "nbHeureHebdomadairerTag" => $this->getNbHeureHebdomadairer(),
            "gratificationTag" => $this->getGratification(),
            "uniteGratificationTag" => $this->getUniteGratification(),
            "uniteDureGratificationTag" => $this->getUniteDureGratification(),
            "conventionValideTag" => $this->getConventionValide(),
            "nomEnseignantReferentTag" => $this->getNomEnseignantReferent(),
            "prenomEnseignentReferentTag" => $this->getPrenomEnseignentReferent(),
            "mailEnseignentReferentTag" => $this->getMailEnseignentReferent(),
            "nomSignataireTag" => $this->getNomSignataire(),
            "prenomSignataireTag" => $this->getPrenomSignataire(),
            "mailSignataireTag" => $this->getMailSignataire(),
            "fonctionSignataireTag" => $this->getFonctionSignataire(),
            "anneeUniversitaireTag" => $this->getAnneeUniversitaire(),
            "typeDeConventionTag" => $this->getTypeDeConvention(),
            "commentaireStageTag" => $this->getCommentaireStage(),
            "commentaireDureeTravailTag" => $this->getCommentaireDureeTravail(),
            "codeELPTag" => $this->getCodeELP(),
            "elementPedagogiqueTag" => $this->getElementPedagogique(),
            "codeSexeEtuTag" => $this->getCodeSexeEtu(),
            "avantageNatureTag" => $this->getAvantageNature(),
            "adresseEtuTag" => $this->getAdresseEtu(),
            "codePostalEtuTag" => $this->getCodePostalEtu(),
            "paysEtuTag" => $this->getPaysEtu(),
            "villeEtuTag" => $this->getVilleEtu(),
            "conventionValidePedagogiqueTag" => $this->getConventionValidePedagogique(),
            "avenantTag" => $this->getAvenant(),
            "detailAvenantTag" => $this->getDetailAvenant(),
            "dateCreationConventionTag" => $this->getDateCreationConvention(),
            "dateModificationConventionTag" => $this->getDateModificationConvention(),
            "origineStageTag" => $this->getOrigineStage(),
            "nomEtablissementTag" => $this->getNomEtablissement(),
            "siretTag" => $this->getSiret(),
            "adresseResidenceTag" => $this->getAdresseResidence(),
            "adresseVoieTag" => $this->getAdresseVoie(),
            "adresseLibCedexTag" => $this->getAdresseLibCedex(),
            "codePostalTag" => $this->getCodePostal(),
            "communeEtabAcceuilTag" => $this->getCommuneEtabAcceuil(),
            "paysEtablissementTag" => $this->getPaysEtablissement(),
            "statutJuridiqueTag" => $this->getStatutJuridique(),
            "typeStructureTag" => $this->getTypeStructure(),
            "effectifTag" => $this->getEffectif(),
            "codeNAFTag" => $this->getCodeNAF(),
            "telEtablissementTag" => $this->getTelEtablissement(),
            "faxTag" => $this->getFax(),
            "mailEtablissementTag" => $this->getMailEtablissement(),
            "siteWebTag" => $this->getSiteWeb(),
            "nomServiceAcceuilTag" => $this->getNomServiceAcceuil(),
            "residenceServiceAcceuilTag" => $this->getResidenceServiceAcceuil(),
            "voieServiceAcceuilTag" => $this->getVoieServiceAcceuil(),
            "cedexServiceAcceuilTag" => $this->getCedexServiceAcceuil(),
            "codePostalServiceAcceuilTag" => $this->getCodePostalServiceAcceuil(),
            "communeServiceAcceuilTag" => $this->getCommuneServiceAcceuil(),
            "paysServiceAcceuilTag" => $this->getPaysServiceAcceuil(),
            "nomTuteurProfessionnelTag" => $this->getNomTuteurProfessionnel(),
            "prenomTuteurProfessionnelTag" => $this->getPrenomTuteurProfessionnel(),
            "mailTuteurProfessionnelTag" => $this->getMailTuteurProfessionnel(),
            "telTuteurProfessionnelTag" => $this->getTelTuteurProfessionnel(),
            "fonctionTuteurProfessionnelTag" => $this->getFonctionTuteurProfessionnel()
        );
    }


}