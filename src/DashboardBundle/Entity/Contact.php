<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="DashboardBundle\Repository\ContactRepository")
 */
class Contact
{
	
	public function getFullname() {
		return $this->firstname." ".$this->lastname;
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    


    /**
     * @ORM\ManyToMany(targetEntity="DashboardBundle\Entity\Capsule", mappedBy="contacts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $capsules;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAddress", type="string", length=255, nullable=true)
     */
    private $emailAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;


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
     * Set firstname
     *
     * @param string $firstname
     * @return Contact
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Contact
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return Contact
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Contact
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Contact
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
     * Constructor
     */
    public function __construct()
    {
        $this->capsules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add capsules
     *
     * @param \DashboardBundle\Entity\Capsule $capsules
     * @return Contact
     */
    public function addCapsule(\DashboardBundle\Entity\Capsule $capsules)
    {
        $this->capsules[] = $capsules;

        return $this;
    }

    /**
     * Remove capsules
     *
     * @param \DashboardBundle\Entity\Capsule $capsules
     */
    public function removeCapsule(\DashboardBundle\Entity\Capsule $capsules)
    {
        $this->capsules->removeElement($capsules);
    }

    /**
     * Get capsules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCapsules()
    {
        return $this->capsules;
    }
}
