<?php

namespace CASTOR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * date_trimestriel
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CASTOR\AdminBundle\Entity\date_trimestrielRepository")
 */
class date_trimestriel
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
     * @ORM\Column(name="date_debut", type="string", length=20)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=20)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="trim_choix", type="string", length=20)
     */
    private $trimChoix;




    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }


    public function getDateDebut()
    {
        return $this->dateDebut;
    }


    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }


    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set trimChoix
     *
     * @param string $trimChoix
     * @return date_trimestriel
     */
    public function setTrimChoix($trimChoix)
    {
        $this->trimChoix = $trimChoix;

        return $this;
    }

    /**
     * Get trimChoix
     *
     * @return string 
     */
    public function getTrimChoix()
    {
        return $this->trimChoix;
    }



}
