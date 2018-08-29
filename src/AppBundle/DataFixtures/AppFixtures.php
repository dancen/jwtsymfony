<?php

namespace AppBundle\DataFixtures;

use AppBundle\Factory\ApiLeagueFactory;
use AppBundle\Factory\ApiTeamFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;

/**
 * Description of AppFixtures
 *
 * @author dan
 */
class AppFixtures extends Fixture implements ORMFixtureInterface {

   

    public function load(ObjectManager $manager) { 
        
        $connection = $manager->getConnection();
        $connection->exec("SET FOREIGN_KEY_CHECKS = 0;");       
        $connection->exec("TRUNCATE api_league"); 
        $connection->exec("TRUNCATE api_team");
        $connection->exec("ALTER TABLE api_league AUTO_INCREMENT = 1;");
        $connection->exec("ALTER TABLE api_team AUTO_INCREMENT = 1;");
        $connection->exec("SET FOREIGN_KEY_CHECKS = 1;"); 
        
        
                    
       
        // create 5 leagues
        for ($i = 0; $i < 5; $i++) {
            $league = ApiLeagueFactory::create();
            $league->setName('Premier League ' . $i);
            $manager->persist($league);

            // create 20 teams
            for ($y = 0; $y < 20; $y++) {
                $team = ApiTeamFactory::create();
                $team->setLeague($league);
                $team->setName('Team '  . $y);
                $team->setStrip('Strip '  . $y);
                $manager->persist($team);
            }
        }

        $manager->flush();
    }

}
