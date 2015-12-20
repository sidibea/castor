<?php

namespace CASTOR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eleves
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CASTOR\AdminBundle\Entity\ElevesRepository")
 */
class Eleves
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="dob", type="string", length=14)
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_naissance", type="string", length=255)
     */
    private $lieuNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="CASTOR\AdminBundle\Entity\classes", cascade={"persist"})
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_sanitaire", type="string", length=255)
     */
    private $etatSanitaire;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissement_origine", type="string", length=255)
     */
    private $etablissementOrigine;

    /**
     * @var string
     *
     * @ORM\Column(name="langue_vivante", type="string", length=255)
     */
    private $langueVivante;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_pere", type="string", length=255)
     */
    private $nomPere;

    /**
     * @var string
     *
     * @ORM\Column(name="profession_pere", type="string", length=255)
     */
    private $professionPere;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_pere", type="string", length=255)
     */
    private $telPere;

    /**
     * @var string
     *
     * @ORM\Column(name="email_pere", type="string", length=255)
     */
    private $emailPere;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_mere", type="string", length=255)
     */
    private $nomMere;

    /**
     * @var string
     *
     * @ORM\Column(name="profession_mere", type="string", length=255)
     */
    private $professionMere;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_mere", type="string", length=255)
     */
    private $telMere;

    /**
     * @var string
     *
     * @ORM\Column(name="email_mere", type="string", length=255)
     */
    private $emailMere;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_upd", type="datetime")
     */
    private $dateUpd;

    public function __construct(){
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Eleves
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Eleves
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Eleves
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dob
     *
     * @param string $dob
     * @return Eleves
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return string 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set lieuNaissance
     *
     * @param string $lieuNaissance
     * @return Eleves
     */
    public function setLieuNaissance($lieuNaissance)
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    /**
     * Get lieuNaissance
     *
     * @return string 
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return Eleves
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set etatSanitaire
     *
     * @param string $etatSanitaire
     * @return Eleves
     */
    public function setEtatSanitaire($etatSanitaire)
    {
        $this->etatSanitaire = $etatSanitaire;

        return $this;
    }

    /**
     * Get etatSanitaire
     *
     * @return string 
     */
    public function getEtatSanitaire()
    {
        return $this->etatSanitaire;
    }

    /**
     * Set etablissementOrigine
     *
     * @param string $etablissementOrigine
     * @return Eleves
     */
    public function setEtablissementOrigine($etablissementOrigine)
    {
        $this->etablissementOrigine = $etablissementOrigine;

        return $this;
    }

    /**
     * Get etablissementOrigine
     *
     * @return string 
     */
    public function getEtablissementOrigine()
    {
        return $this->etablissementOrigine;
    }

    /**
     * Set langueVivante
     *
     * @param string $langueVivante
     * @return Eleves
     */
    public function setLangueVivante($langueVivante)
    {
        $this->langueVivante = $langueVivante;

        return $this;
    }

    /**
     * Get langueVivante
     *
     * @return string 
     */
    public function getLangueVivante()
    {
        return $this->langueVivante;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Eleves
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set nomPere
     *
     * @param string $nomPere
     * @return Eleves
     */
    public function setNomPere($nomPere)
    {
        $this->nomPere = $nomPere;

        return $this;
    }

    /**
     * Get nomPere
     *
     * @return string 
     */
    public function getNomPere()
    {
        return $this->nomPere;
    }

    /**
     * Set professionPere
     *
     * @param string $professionPere
     * @return Eleves
     */
    public function setProfessionPere($professionPere)
    {
        $this->professionPere = $professionPere;

        return $this;
    }

    /**
     * Get professionPere
     *
     * @return string 
     */
    public function getProfessionPere()
    {
        return $this->professionPere;
    }

    /**
     * Set telPere
     *
     * @param string $telPere
     * @return Eleves
     */
    public function setTelPere($telPere)
    {
        $this->telPere = $telPere;

        return $this;
    }

    /**
     * Get telPere
     *
     * @return string 
     */
    public function getTelPere()
    {
        return $this->telPere;
    }

    /**
     * Set emailPere
     *
     * @param string $emailPere
     * @return Eleves
     */
    public function setEmailPere($emailPere)
    {
        $this->emailPere = $emailPere;

        return $this;
    }

    /**
     * Get emailPere
     *
     * @return string 
     */
    public function getEmailPere()
    {
        return $this->emailPere;
    }

    /**
     * Set nomMere
     *
     * @param string $nomMere
     * @return Eleves
     */
    public function setNomMere($nomMere)
    {
        $this->nomMere = $nomMere;

        return $this;
    }

    /**
     * Get nomMere
     *
     * @return string 
     */
    public function getNomMere()
    {
        return $this->nomMere;
    }

    /**
     * Set professionMere
     *
     * @param string $professionMere
     * @return Eleves
     */
    public function setProfessionMere($professionMere)
    {
        $this->professionMere = $professionMere;

        return $this;
    }

    /**
     * Get professionMere
     *
     * @return string 
     */
    public function getProfessionMere()
    {
        return $this->professionMere;
    }

    /**
     * Set telMere
     *
     * @param string $telMere
     * @return Eleves
     */
    public function setTelMere($telMere)
    {
        $this->telMere = $telMere;

        return $this;
    }

    /**
     * Get telMere
     *
     * @return string 
     */
    public function getTelMere()
    {
        return $this->telMere;
    }

    /**
     * Set emailMere
     *
     * @param string $emailMere
     * @return Eleves
     */
    public function setEmailMere($emailMere)
    {
        $this->emailMere = $emailMere;

        return $this;
    }

    /**
     * Get emailMere
     *
     * @return string 
     */
    public function getEmailMere()
    {
        return $this->emailMere;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Eleves
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Eleves
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime 
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set dateUpd
     *
     * @param \DateTime $dateUpd
     * @return Eleves
     */
    public function setDateUpd($dateUpd)
    {
        $this->dateUpd = $dateUpd;

        return $this;
    }

    /**
     * Get dateUpd
     *
     * @return \DateTime 
     */
    public function getDateUpd()
    {
        return $this->dateUpd;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     */
    public function setClasse(classes $classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }




}
