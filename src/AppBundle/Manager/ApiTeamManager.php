<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Manager\ApiManager;
use AppBundle\Entity\ApiTeam;
use AppBundle\Factory\ApiTeamFactory;
use AppBundle\Entity\ApiLeague;

/**
 * Description of ApiTeamManager
 *
 * @author dan
 */
class ApiTeamManager extends ApiManager {

    /**
     * Returns 
     *
     * @param  
     * @return 
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * getTeams 
     * get all teams
     *
     * @param null
     * @return mixed
     */
    public function getTeamsByLeague($league_id) {

        $teams = $this->em->getRepository(ApiTeam::class)
                        ->createQueryBuilder('e')
                        ->select('e')
                        ->where('e.league = ?1')
                        ->setParameter(1, $league_id)
                        ->getQuery()
                        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        if ($teams) {

            return $teams;
        } else {
            return null;
        }
    }

    /**
     * getTeams 
     * get all teams
     *
     * @param null
     * @return mixed
     */
    public function getTeams() {

        $teams = $this->em->getRepository(ApiTeam::class)
                ->createQueryBuilder('e')
                ->select('e')
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);


        if (count($teams) > 0) {

            return $teams;
        } else {
            return null;
        }
    }

    /**
     * createTeam 
     * create a new team
     *
     * @param int $league_id
     * @param string $team_name
     * @param string $strip
     * @return mixed
     */
    public function createTeam($league_id, $team_name, $strip) {

        $league = $this->em->getRepository(ApiLeague::class)->find($league_id);

        if ($league) {
            $team = $this->em->getRepository(ApiTeam::class)->findOneBy(
                    array("league" => $league_id,
                        "name" => $team_name));

            if (!$team) {
                $team = ApiTeamFactory::create();
            }

            $team->setLeague($league);
            $team->setName($team_name);
            $team->setStrip($strip);
            $this->em->persist($team);
            $this->em->flush();
            
            return $team->getId();
            
        } else {
            return null;
        }
    }

    /**
     * getTeam 
     * get a team
     *
     * @param int $team_id
     * @return mixed
     */
    public function getTeam($team_id) {
        
        $team = $this->em->getRepository(ApiTeam::class)
                ->createQueryBuilder('e')
                ->select('e')
                ->where('e.id = ?1')
                ->setParameter(1, $team_id)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        

        if ($team) {

            return $team;
        } else {
            return null;
        }
    }

    /**
     * updateTeam 
     * modify a team
     *
     * @param int $team_id
     * @param int $league_id
     * @param string $team_name
     * @param string $strip
     * @return mixed
     */
    public function updateTeam($team_id, $league_id, $team_name, $strip) {

        $team = $this->em->getRepository(ApiTeam::class)->find($team_id);

        if ($team) {

            $league = $this->em->getRepository(ApiLeague::class)->find($league_id);

            if ($league) {

                $team->setLeague($league);
                $team->setName($team_name);
                $team->setStrip($strip);
                $team->setUpdatedAt(new \Datetime('now'));
                $this->em->persist($team);
                $this->em->flush();

                return true;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * deleteTeam 
     * delete a team
     *
     * @param int $team_id
     * @return mixed
     */
    public function deleteTeam($team_id) {

        $team = $this->em->getRepository(ApiTeam::class)->find($team_id);

        if ($team) {

            $this->em->remove($team);
            $this->em->flush();
            return true;
        } else {
            return null;
        }
    }

}
