<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppBundle\Entity\ApiTeam
 *
 * @ORM\Table(name="api_team")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ApiTeamRepository")
 */
class ApiTeam {

    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id; 
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;  
    
    /**
     * @var string $strip
     *
     * @ORM\Column(name="strip", type="string", length=100, nullable=false)
     */
    private $strip; 
    
    
    /**
     * Many Teams have One League.
     * @ORM\ManyToOne(targetEntity="ApiLeague", inversedBy="teams")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    private $league;
    
    
    
    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $created_at;
    
    
    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updated_at;    
    

    /**
     * Constructor
     */
    public function __construct() {
        $this->setCreatedAt(new \Datetime("now"));
        $this->setUpdatedAt(new \Datetime("now"));
    }
    
     /**
     * Set id
     *
     * @return integer
     */
    public function setId($id)
    {
        $this->id = $id;
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
     *
     * @return ApiTeam
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
     * Set strip
     *
     * @param string $strip
     *
     * @return ApiTeam
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * Get strip
     *
     * @return string
     */
    public function getStrip()
    {
        return $this->strip;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ApiTeam
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ApiTeam
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set league
     *
     * @param \AppBundle\Entity\ApiLeague $league
     *
     * @return ApiTeam
     */
    public function setLeague(\AppBundle\Entity\ApiLeague $league = null)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return \AppBundle\Entity\ApiLeague
     */
    public function getLeague()
    {
        return $this->league;
    }
}
