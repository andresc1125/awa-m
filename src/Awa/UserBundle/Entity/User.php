<?php
namespace Awa\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Awa\UserBundle\Entity\User
 *
 * @ORM\Table(name="awa_users")
 * @ORM\Entity(repositoryClass="Awa\UserBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
	
	/**
	* @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
	*
	*/
	private $roles;

    /**
    * @ORM\OneToOne(targetEntity="Awa\BussinessBundle\Entity\Distributor")
    * @ORM\JoinColumn(name="distributor_id", referencedColumnName="id")
    */
    private $distributor;

	
    public function __construct()
    {
        
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->roles = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }
    
    public function isAccountNonExpired()
    {
		return true;
	}
	
	public function isAccountNonLocked()
	{
		return true;
	}
	
	public function isCredentialsNonExpired()
	{
		return true;
	} 
	
	public function isEnabled()
	{
		return $this->isActive;
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add roles
     *
     * @param \Awa\UserBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\Awa\UserBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Awa\UserBundle\Entity\Role $roles
     */
    public function removeRole(\Awa\UserBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }
    
    public function __toString()
    {
		return $this->username;
	}

    /**
     * Set distributor
     *
     * @param \Awa\BussinessBundle\Entity\Distributor $distributor
     * @return User
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
}