<?php

namespace DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="DashboardBundle\Repository\FileRepository")
 */
class File
{
	public function isImage() {
		$isImage = false;
		
		$ext = strtolower($this->extension);
		
		if ($ext == "bmp" || $ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif") {
			$isImage = true;
		}
		
		return $isImage;
	}
	
	public function isPdf() {
		return (strtolower($this->extension) == "pdf");
	}
	
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    public function __construct()
    {
    	$this->dateUpload = new \Datetime();
    }
    
   
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateUpload", type="datetime")
     */
    private $dateUpload;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="text", nullable=true)
     */
    private $extension;
    
    

    /**
     * @ORM\ManyToMany(targetEntity="DashboardBundle\Entity\Capsule", mappedBy="files")
     * @ORM\JoinColumn(nullable=true)
     */
    private $capsules;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    

    public function getAbsolutePath() {
    	return $this->getUploadRootDir().'/'.$this->id.".".$this->extension;
    }
    
    
    public function upload($file)
    {
    	// Si jamais il n'y a pas de fichier (champ facultatif)
    	if (null === $file) {
    		return;
    	}
    
    
    	// Si on avait un ancien fichier, on le supprime
    	if (null !== $this->extension) {
    		$oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->extension;
    		if (file_exists($oldFile)) {
    			unlink($oldFile);
    		}
    	}
    
    	$this->extension = $file->guessExtension();
    
    	// On déplace le fichier envoyé dans le répertoire de notre choix
    	$file->move(
    			$this->getUploadRootDir(), // Le répertoire de destination
    			$this->id.'.'.$this->extension   // Le nom du fichier à créer, ici « id.extension »
    	);
    }
    
    
    
    public function getUploadDir()
    {
    	// On retourne le chemin relatif vers l'image pour un navigateur
    	return 'files';
    }
    
    
    public function getUploadRootDir()
    {
    	// On retourne le chemin relatif vers l'image pour notre code PHP
    	return __DIR__.'/../../../userFiles/'.$this->user->getId().'/'.$this->getUploadDir();
    }
    
    
    
    
    

    /**
     * Set dateUpload
     *
     * @param \DateTime $dateUpload
     * @return File
     */
    public function setDateUpload($dateUpload)
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    /**
     * Get dateUpload
     *
     * @return \DateTime 
     */
    public function getDateUpload()
    {
        return $this->dateUpload;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return File
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return File
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Add capsules
     *
     * @param \DashboardBundle\Entity\Capsule $capsules
     * @return File
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return File
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
}
