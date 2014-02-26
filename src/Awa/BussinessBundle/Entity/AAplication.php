<?php

namespace Awa\BussinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AAplication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\BussinessBundle\Entity\AAplicationRepository")
 */
class AAplication
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
     * @var string
     *
     * @ORM\Column(name="url_descarga", type="text")
     */
    private $urlDescarga;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

	
	/**
	* @ORM\ManyToOne(targetEntity="Awa\BussinessBundle\Entity\Distributor", inversedBy="aplications")
	* @ORM\JoinColumn(name="distributor_id", referencedColumnName="id")
	*/
	protected $distributor;
	
	/**
	* @ORM\ManyToOne(targetEntity="Awa\BussinessBundle\Entity\Currency", inversedBy="aplications")
	* @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
	*/
	protected $currency;
	
	
	/**
	* @ORM\ManyToMany(targetEntity="Awa\BussinessBundle\Entity\Category", inversedBy="aplications")
	* 
	*/
	protected $categories;
	
	
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
     * @return AAplication
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
     * Set price
     *
     * @param float $price
     * @return AAplication
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set distributor
     *
     * @param \Awa\BussinessBundle\Entity\Distributor $distributor
     * @return AAplication
     */
    public function setDistributor(\Awa\BussinessBundle\Entity\Distributor $distributor = null)
    {
        $this->distributor = $distributor;
    
        return $this;
    }

    /**
     * Get distributor
     *
     * @return \Awa\BussinessBundle\Entity\Distributor 
     */
    public function getDistributor()
    {
        return $this->distributor;
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }
    
    /**
     * Add categories
     *
     * @param \Awa\BussinessBundle\Entity\Category $categories
     * @return AAplication
     */
    public function addCategorie(\Awa\BussinessBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Awa\BussinessBundle\Entity\Category $categories
     */
    public function removeCategorie(\Awa\BussinessBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    public function __toString()
    {
		return $this->getName();
	}

    /**
     * Set currency
     *
     * @param \Awa\BussinessBundle\Entity\Currency $currency
     * @return AAplication
     */
    public function setCurrency(\Awa\BussinessBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency
     *
     * @return \Awa\BussinessBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set urlDescarga
     *
     * @param string $urlDescarga
     * @return AAplication
     */
    public function setUrlDescarga($urlDescarga)
    {
        $this->urlDescarga = $urlDescarga;
    
        return $this;
    }

    /**
     * Get urlDescarga
     *
     * @return string 
     */
    public function getUrlDescarga()
    {
        return $this->urlDescarga;
    }
}