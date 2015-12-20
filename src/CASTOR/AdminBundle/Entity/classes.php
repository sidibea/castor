<?php

namespace CASTOR\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * classes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CASTOR\AdminBundle\Entity\classesRepository")
 */
class classes
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isEnabled", type="boolean")
     */
    private $isEnabled;

    /**
     * @ORM\ManyToMany(targetEntity="CASTOR\AdminBundle\Entity\date_trimestriel", cascade={"persist", "remove"})
     */
    private $date_trimestriel;

    public function __construct(){
        $this->date_trimestriel = new ArrayCollection();
    }
    public function setDateTrimestriel(date_trimestriel $date_trimestriel = null)
    {
        $this->date_trimestriel = $date_trimestriel;
    }


    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addDateTrimestriel(date_trimestriel $date_trimestriel)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->date_trimestriel[] = $date_trimestriel;

        return $this;
    }

    public function removeDateTrimestriel(date_trimestriel $date_trimestriel)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->date_trimestriel->removeElement($date_trimestriel);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getDateTrimestriel()
    {
        return $this->date_trimestriel;
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
     * Set code
     *
     * @param string $code
     * @return classes
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return classes
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
     * Set isEnabled
     *
     * @param boolean $isEnabled
     * @return classes
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean 
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }




}
