<?php

namespace CASTOR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Param
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CASTOR\AdminBundle\Entity\ParamRepository")
 */
class Param
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
     * @ORM\Column(name="nom_directeur", type="string", length=255)
     */
    private $nomDirecteur;

    /**
     * @var string
     *
     * @ORM\Column(name="signature_directeur", type="string", length=255)
     */
    private $signatureDirecteur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_etablissement", type="string", length=255)
     */
    private $nomEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="academie", type="string", length=255)
     */
    private $academie;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_scolaire", type="string", length=18)
     */
    private $anneeScolaire;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=55)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="siteweb", type="string", length=255)
     */
    private $siteweb;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;


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
     * Set nomDirecteur
     *
     * @param string $nomDirecteur
     * @return Param
     */
    public function setNomDirecteur($nomDirecteur)
    {
        $this->nomDirecteur = $nomDirecteur;

        return $this;
    }

    /**
     * Get nomDirecteur
     *
     * @return string 
     */
    public function getNomDirecteur()
    {
        return $this->nomDirecteur;
    }

    /**
     * Set signatureDirecteur
     *
     * @param string $signatureDirecteur
     * @return Param
     */
    public function setSignatureDirecteur($signatureDirecteur)
    {
        $this->signatureDirecteur = $signatureDirecteur;

        return $this;
    }

    /**
     * Get signatureDirecteur
     *
     * @return string 
     */
    public function getSignatureDirecteur()
    {
        return $this->signatureDirecteur;
    }

    /**
     * Set nomEtablissement
     *
     * @param string $nomEtablissement
     * @return Param
     */
    public function setNomEtablissement($nomEtablissement)
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    /**
     * Get nomEtablissement
     *
     * @return string 
     */
    public function getNomEtablissement()
    {
        return $this->nomEtablissement;
    }

    /**
     * Set academie
     *
     * @param string $academie
     * @return Param
     */
    public function setAcademie($academie)
    {
        $this->academie = $academie;

        return $this;
    }

    /**
     * Get academie
     *
     * @return string 
     */
    public function getAcademie()
    {
        return $this->academie;
    }

    /**
     * Set anneeScolaire
     *
     * @param string $anneeScolaire
     * @return Param
     */
    public function setAnneeScolaire($anneeScolaire)
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }

    /**
     * Get anneeScolaire
     *
     * @return string 
     */
    public function getAnneeScolaire()
    {
        return $this->anneeScolaire;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Param
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
     * Set codePostal
     *
     * @param string $codePostal
     * @return Param
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Param
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Param
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Param
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siteweb
     *
     * @param string $siteweb
     * @return Param
     */
    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * Get siteweb
     *
     * @return string 
     */
    public function getSiteweb()
    {
        return $this->siteweb;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Param
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
