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
     * @var boolean
     *
     * @ORM\Column(name="authorized", type="boolean")
     */
    private $authorized;
	
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
	* @ORM\OneToMany(targetEntity="Awa\BussinessBundle\Entity\AplicationImage", mappedBy="aaplication")
	*/
	protected $images;

	/**
	* @ORM\ManyToOne(targetEntity="Awa\BussinessBundle\Entity\Platform", inversedBy="aplications")
	* @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
	*/
	protected $platform;
	
	
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
        $this->images = new ArrayCollection();
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

    /**
     * Add aplications
     *
     * @param \Awa\BussinessBundle\Entity\AplicationImage $aplications
     * @return AAplication
     */
    public function addAplication(\Awa\BussinessBundle\Entity\AplicationImage $aplications)
    {
        $this->aplications[] = $aplications;
    
        return $this;
    }

    /**
     * Remove aplications
     *
     * @param \Awa\BussinessBundle\Entity\AplicationImage $aplications
     */
    public function removeAplication(\Awa\BussinessBundle\Entity\AplicationImage $aplications)
    {
        $this->aplications->removeElement($aplications);
    }

    /**
     * Get aplications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAplications()
    {
        return $this->aplications;
    }

    /**
     * Add images
     *
     * @param \Awa\BussinessBundle\Entity\AplicationImage $images
     * @return AAplication
     */
    public function addImage(\Awa\BussinessBundle\Entity\AplicationImage $images)
    {
        $this->images[] = $images;
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param \Awa\BussinessBundle\Entity\AplicationImage $images
     */
    public function removeImage(\Awa\BussinessBundle\Entity\AplicationImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set platform
     *
     * @param \Awa\BussinessBundle\Entity\Platform $platform
     * @return AAplication
     */
    public function setPlatform(\Awa\BussinessBundle\Entity\Platform $platform = null)
    {
        $this->platform = $platform;
    
        return $this;
    }

    /**
     * Get platform
     *
     * @return \Awa\BussinessBundle\Entity\Platform 
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set authorized
     *
     * @param boolean $authorized
     * @return AAplication
     */
    public function setAuthorized($authorized)
    {
        $this->authorized = $authorized;
    
        return $this;
    }

    /**
     * Get authorized
     *
     * @return boolean 
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }
}