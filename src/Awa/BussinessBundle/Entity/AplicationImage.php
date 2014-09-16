<?php

namespace Awa\BussinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * AplicationImage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Awa\BussinessBundle\Entity\AplicationImageRepository")
 */
class AplicationImage
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    private $weight;
    
	/**
	* @ORM\ManyToOne(targetEntity="Awa\BussinessBundle\Entity\AAplication", inversedBy="images")
	* @ORM\JoinColumn(name="aplication_id", referencedColumnName="id")
	*/
    protected $aaplication;
    


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
     * Set path
     *
     * @param string $path
     * @return AplicationImage
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
    * @Assert\File(maxSize="6000000")
    */
    private $image;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setImage(UploadedFile $image = null)
    {
        $this->image = $image;
    }

    /**
     * Get image.
     *
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/aplication_images';
    }
    


    /**
     * Set weight
     *
     * @param integer $weight
     * @return AplicationImage
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    
        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set aaplication
     *
     * @param \Awa\BussinessBundle\Entity\AAplication $aaplication
     * @return AplicationImage
     */
    public function setAaplication(\Awa\BussinessBundle\Entity\AAplication $aaplication = null)
    {
        $this->aaplication = $aaplication;
    
        return $this;
    }

    /**
     * Get aaplication
     *
     * @return \Awa\BussinessBundle\Entity\AAplication 
     */
    public function getAaplication()
    {
        return $this->aaplication;
    }
    
    public function upload()
    {
		// the file property can be empty if the field is not required
		if (null === $this->getImage()) {
			return;
		}
		
		// use the original file name here but you should
		// sanitize it at least to avoid any security issues

		// move takes the target directory and then the
		// target filename to move to
		$namePrefix =  date('H-mm-ss').rand(0, 10000);
		$this->getImage()->move(
			$this->getUploadRootDir(),
			$namePrefix.$this->getImage()->getClientOriginalName()
		);
                $newName = $namePrefix.$this->getImage()->getClientOriginalName();
                $newFullPath = $this->getUploadRootDir().DIRECTORY_SEPARATOR.$newName;
		$this->setWeight(filesize($newFullPath));
		// set the path property to the filename where you've saved the file
		$this->path = $newName;

		// clean up the file property as you won't need it anymore
		$this->image = null;
    }
    
    public function __tostring()
    {
      return $this->path;
    }
}