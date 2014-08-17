<?php

namespace Awa\BussinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Distributor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\BussinessBundle\Entity\DistributorRepository")
 */
class Distributor
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
     * @var boolean
     *
     * @ORM\Column(name="authorized", type="boolean")
     */
    private $authorized;

	/**
	* @ORM\OneToMany(targetEntity="Awa\BussinessBundle\Entity\AAplication", mappedBy="distributor")
	*/
	protected $aplications;

    /**
    * @ORM\OneToMany(targetEntity="Awa\UserBundle\Entity\User", mappedBy="distributor")
    */
    protected $users;

	
	public function __construct()
	{
		$this->aplications = new ArrayCollection();
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
     * @return Distributor
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
     * Add aplications
     *
     * @param \Awa\BussinessBundle\Entity\AAplication $aplications
     * @return Distributor
     */
    public function addAplication(\Awa\BussinessBundle\Entity\AAplication $aplications)
    {
        $this->aplications[] = $aplications;
    
        return $this;
    }

    /**
     * Remove aplications
     *
     * @param \Awa\BussinessBundle\Entity\AAplication $aplications
     */
    public function removeAplication(\Awa\BussinessBundle\Entity\AAplication $aplications)
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
    
    public function __toString()
    {
		return $this->name;
	}

    /**
     * Set authorized
     *
     * @param boolean $authorized
     * @return Distributor
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

    /**
     * Add users
     *
     * @param \Awa\UserBundle\Entity\User $users
     * @return Distributor
     */
    public function addUser(\Awa\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Awa\UserBundle\Entity\User $users
     */
    public function removeUser(\Awa\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}