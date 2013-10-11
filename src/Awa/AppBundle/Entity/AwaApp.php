<?php

namespace Awa\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AwaApp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\AppBundle\Entity\AwaAppRepository")
 */
class AwaApp
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
     * @ORM\Column(type="string", length=40)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;
    
    /**
     * @ORM\Column(type="date")
     */
    private $dateCreate;
    
    /**
     * @ORM\Column(type="date")
     */
    private $dateModify;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $numViews;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $numGo;
    
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
     * Set name
     *
     * @param string $name
     * @return AwaApp
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AwaApp
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return AwaApp
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    
        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateModify
     *
     * @param \DateTime $dateModify
     * @return AwaApp
     */
    public function setDateModify($dateModify)
    {
        $this->dateModify = $dateModify;
    
        return $this;
    }

    /**
     * Get dateModify
     *
     * @return \DateTime 
     */
    public function getDateModify()
    {
        return $this->dateModify;
    }

    /**
     * Set numViews
     *
     * @param integer $numViews
     * @return AwaApp
     */
    public function setNumViews($numViews)
    {
        $this->numViews = $numViews;
    
        return $this;
    }

    /**
     * Get numViews
     *
     * @return integer 
     */
    public function getNumViews()
    {
        return $this->numViews;
    }

    /**
     * Set numGo
     *
     * @param integer $numGo
     * @return AwaApp
     */
    public function setNumGo($numGo)
    {
        $this->numGo = $numGo;
    
        return $this;
    }

    /**
     * Get numGo
     *
     * @return integer 
     */
    public function getNumGo()
    {
        return $this->numGo;
    }
}