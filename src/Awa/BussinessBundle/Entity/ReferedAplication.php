<?php

namespace Awa\BussinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferedAplication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\BussinessBundle\Entity\ReferedAplicationRepository")
 */
class ReferedAplication
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
     * @ORM\OneToOne(targetEntity="AAplication")
     * @ORM\JoinColumn(name="aplication_id",referencedColumnName="id")
     **/
    private $aplication;
    
    /**
     * @ORM\ManyToOne(targetEntity="BussinessCategory",inversedBy="referedApps")
     * @ORM\JoinColumn(name="bussiness_category_id",referencedColumnName="id")
     **/
    private $bussinessCategory;


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
     * Set aplication
     *
     * @param \Awa\BussinessBundle\Entity\AAplication $aplication
     * @return ReferedAplication
     */
    public function setAplication(\Awa\BussinessBundle\Entity\AAplication $aplication = null)
    {
        $this->aplication = $aplication;
    
        return $this;
    }

    /**
     * Get aplication
     *
     * @return \Awa\BussinessBundle\Entity\AAplication 
     */
    public function getAplication()
    {
        return $this->aplication;
    }

    /**
     * Set bussinessCategoryId
     *
     * @param \Awa\BussinessBundle\Entity\BussinessCategory $bussinessCategoryId
     * @return ReferedAplication
     */
    public function setBussinessCategory(\Awa\BussinessBundle\Entity\BussinessCategory $bussinessCategory = null)
    {
        $this->bussinessCategory = $bussinessCategory;
    
        return $this;
    }

    /**
     * Get bussinessCategoryId
     *
     * @return \Awa\BussinessBundle\Entity\BussinessCategory 
     */
    public function getBussinessCategory()
    {
        return $this->bussinessCategory;
    }
}