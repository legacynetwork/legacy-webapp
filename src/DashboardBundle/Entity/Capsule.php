<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Capsule
 *
 * @ORM\Table(name="capsule")
 * @ORM\Entity(repositoryClass="DashboardBundle\Repository\CapsuleRepository")
 */
class Capsule
{
	
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->dateCreation = new \Datetime();
		$this->dateLastUpdate = new \Datetime();
	}
	
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="DashboardBundle\Entity\File", inversedBy="capsules")
     * @ORM\JoinColumn(nullable=true)
     */
    private $files;

    /**
     * @ORM\ManyToMany(targetEntity="DashboardBundle\Entity\Contact", inversedBy="capsules")
     * @ORM\JoinColumn(nullable=true)
     */
    private $contacts;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="capsules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLastUpdate", type="datetime")
     */
    private $dateLastUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;


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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Capsule
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateLastUpdate
     *
     * @param \DateTime $dateLastUpdate
     * @return Capsule
     */
    public function setDateLastUpdate($dateLastUpdate)
    {
        $this->dateLastUpdate = $dateLastUpdate;

        return $this;
    }

    /**
     * Get dateLastUpdate
     *
     * @return \DateTime 
     */
    public function getDateLastUpdate()
    {
        return $this->dateLastUpdate;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Capsule
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
     * Add files
     *
     * @param \DashboardBundle\Entity\File $files
     * @return Capsule
     */
    public function addFile(\DashboardBundle\Entity\File $files)
    {
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files
     *
     * @param \DashboardBundle\Entity\File $files
     */
    public function removeFile(\DashboardBundle\Entity\File $files)
    {
        $this->files->removeElement($files);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Capsule
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add contacts
     *
     * @param \DashboardBundle\Entity\Contact $contacts
     * @return Capsule
     */
    public function addContact(\DashboardBundle\Entity\Contact $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \DashboardBundle\Entity\Contact $contacts
     */
    public function removeContact(\DashboardBundle\Entity\Contact $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
