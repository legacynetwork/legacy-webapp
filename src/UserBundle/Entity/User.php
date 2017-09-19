<?php
// src/UserBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
	

	/**
	 * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\Contact", mappedBy="user")
	 * @ORM\OrderBy({"firstname" = "ASC"})
	 */
	private $contacts;
	
	

	/**
	 * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\Capsule", mappedBy="user")
	 * @ORM\OrderBy({"dateCreation" = "DESC"})
	 */
	private $capsules;
	
	

	/**
	 * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\File", mappedBy="user")
	 * @ORM\OrderBy({"id" = "DESC"})
	 */
	private $files;
	
	
	
	
	public function getRolesInString() {
		$rolesInString = "";
		foreach($this->getRoles() as $currentRole) {
			
				if (!empty($rolesInString)) {
					$rolesInString .= " ; ";
				}
				$rolesInString .= $currentRole;
			
		}
	
		return $rolesInString;
	}
	
	
	public function setEmail($email)
	{
		$email = is_null($email) ? '' : $email;
		parent::setEmail($email);
		$this->setUsername($email);
	
		return $this;
	}
	
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
		$this->companies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contacts
     *
     * @param \DashboardBundle\Entity\Contact $contacts
     * @return User
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

    /**
     * Add capsules
     *
     * @param \DashboardBundle\Entity\Capsule $capsules
     * @return User
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

    /**
     * Add files
     *
     * @param \DashboardBundle\Entity\File $files
     * @return User
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
}
