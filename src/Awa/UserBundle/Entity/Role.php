<?php

namespace Awa\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Role
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\UserBundle\Entity\RoleRepository")
 */
class Role  implements RoleInterface
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
	* @ORM\Column(name="role", type="string", length=20, unique=true)
	*/
	private $role;

	/**
	* @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
	*/
	private $users;

	public function __construct()
	{
		$this->users = new ArrayCollection();
	}
	
	/**
	* @see RoleInterface
	*/
	public function getRole()
	{
		return $this->role;
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
     * @return Role
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
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Add users
     *
     * @param \Awa\UserBundle\Entity\User $users
     * @return Role
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
    
    public function __toString()
    {
		return $this->role;
	}
}
