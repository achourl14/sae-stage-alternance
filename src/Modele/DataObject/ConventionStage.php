<?php

namespace App\Modele\DataObject;

class ConventionStage extends AbstractDataObject
{
    private int|null $numConvention;
    private int|null $numEtudiant;
    private string|null $nomEtu;
    private string|null $prenomEtu;
    private string|null $numTelPersoEtu;
    private string|null $numTelEtu;
    private string|null $mailPersoEtu;
    private string|null $mailUniversitaireEtu;
    private string|null $codeUfr;
    private string|null $libUfr;
    private string|null $codeDepartement;
    private string|null $codeEtape;
    private string|null $libEtape;
    private string|null $dateDebut;
    private string|null $dateFin;
    private string|null $interruption;
    private string|null $dateDebutInterruption;
    private string|null $dateFinInterruption;
    private string|null $thematique;
    private string|null $sujet;
    private string|null $fonctionTache;
    private string|null $detailProjet;
    private string|null $duree;
    private string|null $nbJourTravail;
    private string|null $nbHeureHebdomadairer;
    private float|null $gratification;
    private string|null $uniteGratification;
    private string|null $uniteDureGratification;
    private string|null $conventionValide;
    private string|null $nomEnseignantReferent;
    private string|null $prenomEnseignentReferent;
    private string|null $mailEnseignentReferent;
    private string|null $nomSignataire;
    private string|null $prenomSignataire;
    private string|null $mailSignataire;
    private string|null $fonctionSignataire;
    private string|null $anneeUniversitaire;
    private string|null $typeDeConvention;
    private string|null $commentaireStage;
    private string|null $commentaireDureeTravail;
    private string|null $codeELP;
    private string|null $elementPedagogique;
    private string|null $codeSexeEtu;
    private string|null $avantageNature;
    private string|null $adresseEtu;
    private string|null $codePostalEtu;
    private string|null $paysEtu;
    private string|null $villeEtu;
    private string|null $conventionValidePedagogique;
    private string|null $avenant;
    private string|null $detailAvenant;
    private string|null $dateCreationConvention;
    private string|null $dateModificationConvention;
    private string|null $origineStage;
    private string|null $nomEtablissement;
    private string|null $siret;
    private string|null $adresseResidence;
    private string|null $adresseVoie;
    private string|null $adresseLibCedex;
    private string|null $codePostal;
    private string|null $communeEtabAcceuil;
    private string|null $paysEtablissement;
    private string|null $statutJuridique;
    private string|null $typeStructure;
    private string|null $effectif;
    private string|null $codeNAF;
    private string|null $telEtablissement;
    private string|null $fax;
    private string|null $mailEtablissement;
    private string|null $siteWeb;
    private string|null $nomServiceAcceuil;
    private string|null $residenceServiceAcceuil;
    private string|null $voieServiceAcceuil;
    private string|null $cedexServiceAcceuil;
    private string|null $codePostalServiceAcceuil;
    private string|null $communeServiceAcceuil;
    private string|null $paysServiceAcceuil;
    private string|null $nomTuteurProfessionnel;
    private string|null $prenomTuteurProfessionnel;
    private string|null $mailTuteurProfessionnel;
    private string|null $telTuteurProfessionnel;
    private string|null $fonctionTuteurProfessionnel;

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
    public function __construct(
        ?int $numConvention,
        int $numEtudiant,
        ?string $nomEtu,
        ?string $prenomEtu,
        ?string $numTelPersoEtu,
        ?string $numTelEtu,
        ?string $mailPersoEtu,
        ?string $mailUniversitaireEtu,
        ?string $codeUfr,
        ?string $libUfr,
        ?string $codeDepartement,
        ?string $codeEtape,
        ?string $libEtape,
        ?string $dateDebut,
        ?string $dateFin,
        ?string $interruption,
        ?string $dateDebutInterruption,
        ?string $dateFinInterruption,
        ?string $thematique,
        ?string $sujet,
        ?string $fonctionTache,
        ?string $detailProjet,
        ?string $duree,
        ?string $nbJourTravail,
        ?string $nbHeureHebdomadairer,
        ?float $gratification,
        ?string $uniteGratification,
        ?string $uniteDureGratification,
        ?string $conventionValide,
        ?string $nomEnseignantReferent,
        ?string $prenomEnseignentReferent,
        ?string $mailEnseignentReferent,
        ?string $nomSignataire,
        ?string $prenomSignataire,
        ?string $mailSignataire,
        ?string $fonctionSignataire,
        ?string $anneeUniversitaire,
        ?string $typeDeConvention,
        ?string $commentaireStage,
        ?string $commentaireDureeTravail,
        ?string $codeELP,
        ?string $elementPedagogique,
        ?string $codeSexeEtu,
        ?string $avantageNature,
        ?string $adresseEtu,
        ?string $codePostalEtu,
        ?string $paysEtu,
        ?string $villeEtu,
        ?string $conventionValidePedagogique,
        ?string $avenant,
        ?string $detailAvenant,
        ?string $dateCreationConvention,
        ?string $dateModificationConvention,
        ?string $origineStage,
        ?string $nomEtablissement,
        string $siret,
        ?string $adresseResidence,
        ?string $adresseVoie,
        ?string $adresseLibCedex,
        ?string $codePostal,
        ?string $communeEtabAcceuil,
        ?string $paysEtablissement,
        ?string $statutJuridique,
        ?string $typeStructure,
        ?string $effectif,
        ?string $codeNAF,
        ?string $telEtablissement,
        ?string $fax,
        ?string $mailEtablissement,
        ?string $siteWeb,
        ?string $nomServiceAcceuil,
        ?string $residenceServiceAcceuil,
        ?string $voieServiceAcceuil,
        ?string $cedexServiceAcceuil,
        ?string $codePostalServiceAcceuil,
        ?string $communeServiceAcceuil,
        ?string $paysServiceAcceuil,
        ?string $nomTuteurProfessionnel,
        ?string $prenomTuteurProfessionnel,
        ?string $mailTuteurProfessionnel,
        ?string $telTuteurProfessionnel,
        ?string $fonctionTuteurProfessionnel
    )
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

    public function getNumConvention(): ?int
    {
        return $this->numConvention;
    }

    public function getNumEtudiant(): int
    {
        return $this->numEtudiant;
    }

    public function getNomEtu(): ?string
    {
        return $this->nomEtu;
    }

    public function getPrenomEtu(): ?string
    {
        return $this->prenomEtu;
    }

    public function getNumTelPersoEtu(): ?string
    {
        return $this->numTelPersoEtu;
    }

    public function getNumTelEtu(): ?string
    {
        return $this->numTelEtu;
    }

    public function getMailPersoEtu(): ?string
    {
        return $this->mailPersoEtu;
    }

    public function getMailUniversitaireEtu(): ?string
    {
        return $this->mailUniversitaireEtu;
    }

    public function getCodeUfr(): ?string
    {
        return $this->codeUfr;
    }

    public function getLibUfr(): ?string
    {
        return $this->libUfr;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->codeDepartement;
    }

    public function getCodeEtape(): ?string
    {
        return $this->codeEtape;
    }

    public function getLibEtape(): ?string
    {
        return $this->libEtape;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function getInterruption(): ?string
    {
        return $this->interruption;
    }

    public function getDateDebutInterruption(): ?string
    {
        return $this->dateDebutInterruption;
    }

    public function getDateFinInterruption(): ?string
    {
        return $this->dateFinInterruption;
    }

    public function getThematique(): ?string
    {
        return $this->thematique;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function getFonctionTache(): ?string
    {
        return $this->fonctionTache;
    }

    public function getDetailProjet(): ?string
    {
        return $this->detailProjet;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function getNbJourTravail(): ?string
    {
        return $this->nbJourTravail;
    }

    public function getNbHeureHebdomadairer(): ?string
    {
        return $this->nbHeureHebdomadairer;
    }

    public function getGratification(): ?float
    {
        return $this->gratification;
    }

    public function getUniteGratification(): ?string
    {
        return $this->uniteGratification;
    }

    public function getUniteDureGratification(): ?string
    {
        return $this->uniteDureGratification;
    }

    public function getConventionValide(): ?string
    {
        return $this->conventionValide;
    }

    public function getNomEnseignantReferent(): ?string
    {
        return $this->nomEnseignantReferent;
    }

    public function getPrenomEnseignentReferent(): ?string
    {
        return $this->prenomEnseignentReferent;
    }

    public function getMailEnseignentReferent(): ?string
    {
        return $this->mailEnseignentReferent;
    }

    public function getNomSignataire(): ?string
    {
        return $this->nomSignataire;
    }

    public function getPrenomSignataire(): ?string
    {
        return $this->prenomSignataire;
    }

    public function getMailSignataire(): ?string
    {
        return $this->mailSignataire;
    }

    public function getFonctionSignataire(): ?string
    {
        return $this->fonctionSignataire;
    }

    public function getAnneeUniversitaire(): ?string
    {
        return $this->anneeUniversitaire;
    }

    public function getTypeDeConvention(): ?string
    {
        return $this->typeDeConvention;
    }

    public function getCommentaireStage(): ?string
    {
        return $this->commentaireStage;
    }

    public function getCommentaireDureeTravail(): ?string
    {
        return $this->commentaireDureeTravail;
    }

    public function getCodeELP(): ?string
    {
        return $this->codeELP;
    }

    public function getElementPedagogique(): ?string
    {
        return $this->elementPedagogique;
    }

    public function getCodeSexeEtu(): ?string
    {
        return $this->codeSexeEtu;
    }

    public function getAvantageNature(): ?string
    {
        return $this->avantageNature;
    }

    public function getAdresseEtu(): ?string
    {
        return $this->adresseEtu;
    }

    public function getCodePostalEtu(): ?string
    {
        return $this->codePostalEtu;
    }

    public function getPaysEtu(): ?string
    {
        return $this->paysEtu;
    }

    public function getVilleEtu(): ?string
    {
        return $this->villeEtu;
    }

    public function getConventionValidePedagogique(): ?string
    {
        return $this->conventionValidePedagogique;
    }

    public function getAvenant(): ?string
    {
        return $this->avenant;
    }

    public function getDetailAvenant(): ?string
    {
        return $this->detailAvenant;
    }

    public function getDateCreationConvention(): ?string
    {
        return $this->dateCreationConvention;
    }

    public function getDateModificationConvention(): ?string
    {
        return $this->dateModificationConvention;
    }

    public function getOrigineStage(): ?string
    {
        return $this->origineStage;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function getAdresseResidence(): ?string
    {
        return $this->adresseResidence;
    }

    public function getAdresseVoie(): ?string
    {
        return $this->adresseVoie;
    }

    public function getAdresseLibCedex(): ?string
    {
        return $this->adresseLibCedex;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function getCommuneEtabAcceuil(): ?string
    {
        return $this->communeEtabAcceuil;
    }

    public function getPaysEtablissement(): ?string
    {
        return $this->paysEtablissement;
    }

    public function getStatutJuridique(): ?string
    {
        return $this->statutJuridique;
    }

    public function getTypeStructure(): ?string
    {
        return $this->typeStructure;
    }

    public function getEffectif(): ?string
    {
        return $this->effectif;
    }

    public function getCodeNAF(): ?string
    {
        return $this->codeNAF;
    }

    public function getTelEtablissement(): ?string
    {
        return $this->telEtablissement;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function getMailEtablissement(): ?string
    {
        return $this->mailEtablissement;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function getNomServiceAcceuil(): ?string
    {
        return $this->nomServiceAcceuil;
    }

    public function getResidenceServiceAcceuil(): ?string
    {
        return $this->residenceServiceAcceuil;
    }

    public function getVoieServiceAcceuil(): ?string
    {
        return $this->voieServiceAcceuil;
    }

    public function getCedexServiceAcceuil(): ?string
    {
        return $this->cedexServiceAcceuil;
    }

    public function getCodePostalServiceAcceuil(): ?string
    {
        return $this->codePostalServiceAcceuil;
    }

    public function getCommuneServiceAcceuil(): ?string
    {
        return $this->communeServiceAcceuil;
    }

    public function getPaysServiceAcceuil(): ?string
    {
        return $this->paysServiceAcceuil;
    }

    public function getNomTuteurProfessionnel(): ?string
    {
        return $this->nomTuteurProfessionnel;
    }

    public function getPrenomTuteurProfessionnel(): ?string
    {
        return $this->prenomTuteurProfessionnel;
    }

    public function getMailTuteurProfessionnel(): ?string
    {
        return $this->mailTuteurProfessionnel;
    }

    public function getTelTuteurProfessionnel(): ?string
    {
        return $this->telTuteurProfessionnel;
    }

    public function getFonctionTuteurProfessionnel(): ?string
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