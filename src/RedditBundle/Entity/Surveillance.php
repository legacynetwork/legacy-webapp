<?php

namespace RedditBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Surveillance
 *
 * @ORM\Table(name="surveillance")
 * @ORM\Entity(repositoryClass="RedditBundle\Repository\SurveillanceRepository")
 */
class Surveillance
{
	
	public function __construct()
	{
		$this->dateSurveillance = new \Datetime();
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
     * @ORM\Column(name="dateSurveillance", type="datetime")
     */
    private $dateSurveillance;

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
     * Set dateSurveillance
     *
     * @param \DateTime $dateSurveillance
     * @return Surveillance
     */
    public function setDateSurveillance($dateSurveillance)
    {
        $this->dateSurveillance = $dateSurveillance;

        return $this;
    }

    /**
     * Get dateSurveillance
     *
     * @return \DateTime 
     */
    public function getDateSurveillance()
    {
        return $this->dateSurveillance;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Surveillance
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
