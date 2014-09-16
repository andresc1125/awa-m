<?php

namespace Awa\BussinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BussinessCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\BussinessBundle\Entity\BussinessCategoryRepository")
 */
class BussinessCategory
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="ReferedAplication",mappedBy="bussinessCategory")
     **/
    private $referedApps;
    

    public function __construct() {
        $this->features = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return BussinessCategory
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
     * Get string name
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add referedApps
     *
     * @param \Awa\BussinessBundle\Entity\ReferedAplication $referedApps
     * @return BussinessCategory
     */
    public function addReferedApp(\Awa\BussinessBundle\Entity\ReferedAplication $referedApps)
    {
        $this->referedApps[] = $referedApps;
    
        return $this;
    }

    /**
     * Remove referedApps
     *
     * @param \Awa\BussinessBundle\Entity\ReferedAplication $referedApps
     */
    public function removeReferedApp(\Awa\BussinessBundle\Entity\ReferedAplication $referedApps)
    {
        $this->referedApps->removeElement($referedApps);
    }

    /**
     * Get referedApps
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReferedApps()
    {
        return $this->referedApps;
    }
}