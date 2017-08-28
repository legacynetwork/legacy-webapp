<?php

namespace RedditBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LinkFound
 *
 * @ORM\Table(name="linkFound")
 * @ORM\Entity
 */
class LinkFound
{
	
	public function __construct()
	{
		$this->dateLinkFound = new \Datetime();
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateLinkFound", type="datetime")
     */
    private $dateLinkFound;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;


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
     * Set dateLinkFound
     *
     * @param \DateTime $dateLinkFound
     * @return LinkFound
     */
    public function setDateLinkFound($dateLinkFound)
    {
        $this->dateLinkFound = $dateLinkFound;

        return $this;
    }

    /**
     * Get dateLinkFound
     *
     * @return \DateTime 
     */
    public function getDateLinkFound()
    {
        return $this->dateLinkFound;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return LinkFound
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
