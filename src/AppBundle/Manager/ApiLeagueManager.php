<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Manager\ApiManager;
use AppBundle\Entity\ApiLeague;
use AppBundle\Factory\ApiLeagueFactory;

/**
 * Description of ApiLeagueManager
 *
 * @author dan
 */
class ApiLeagueManager extends ApiManager {

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
     * createLeague 
     * create a new League
     *    
     * @param string $league_name
     * @return 
     */
    public function createLeague($league_name) {

        $league = $this->em->getRepository(ApiLeague::class)->findOneBy(
                array("name" => $league_name));

        if (!$league) {
            $league = ApiLeagueFactory::create();
        }

        $league->setName($league_name);
        $this->em->persist($league);
        $this->em->flush();
        return $league->getId();
    }

    /**
     * getLeagues 
     * get all leagues
     *
     * @param null
     * @return mixed
     */
    public function getLeagues() {

        $leagues = $this->em->getRepository(ApiLeague::class)->createQueryBuilder('e')
                        ->select('e')
                        ->getQuery()
                        ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        if (count($leagues) > 0) {

            return $leagues;
        } else {
            return null;
        }
    }

    /**
     * getLeague 
     * get a League
     *
     * @param int $league_id
     * @return mixed
     */
    public function getLeague($league_id) {

        $league = $this->em->getRepository(ApiLeague::class)
                ->createQueryBuilder('e')
                        ->select('e')
                        ->where('e.id = ?1')
                        ->setParameter(1, $league_id)
                        ->getQuery()
                        ->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        if ($league) {

            return $league;
        } else {
            return null;
        }
    }

    /**
     * updateLeague 
     * modify a League
     *
     * @param int $league_id
     * @param string $league_name
     * @return mixed
     */
    public function updateLeague($league_id, $league_name) {

        $league = $this->em->getRepository(ApiLeague::class)->findOneBy(array("name" => $league_name));

        if (!$league) {

            $league = $this->em->getRepository(ApiLeague::class)->find($league_id);

            if ($league) {
                $league->setName($league_name);
                $league->setUpdatedAt(new \Datetime('now'));
                $this->em->persist($league);
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
     * deleteLeague 
     * delete a league
     *
     * @param int $league_id
     * @return mixed
     */
    public function deleteLeague($league_id) {

        $league = $this->em->getRepository(ApiLeague::class)->find($league_id);

        if ($league) {

            $this->em->remove($league);
            $this->em->flush();
            return true;
        } else {
            return null;
        }
    }

}
