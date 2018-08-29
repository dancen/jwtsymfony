<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\ApiTeam;

/**
 * AppBundle\Entity\ApiLeague
 *
 * @ORM\Table(name="api_league")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ApiLeagueRepository")
 */
class ApiLeague {

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
     * @ORM\Column(name="name", type="string", length=100, unique=true, nullable=false)
     */
    private $name;  
    
    
     /**
     * One League has Many Teams.
     * @ORM\OneToMany(targetEntity="ApiTeam", mappedBy="league", cascade={"all"}, fetch="EAGER")
     */
    private $teams;
    
    
    
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set name
     *
     * @param string $name
     *
     * @return ApiLeague
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ApiLeague
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
     * @return ApiLeague
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
     * Add team
     *
     * @param \AppBundle\Entity\ApiTeam $team
     *
     * @return ApiLeague
     */
    public function addTeam(\AppBundle\Entity\ApiTeam $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\ApiTeam $team
     */
    public function removeTeam(\AppBundle\Entity\ApiTeam $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
