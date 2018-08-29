<?php

namespace AppBundle\Factory;

use AppBundle\DataFixtures\AppFixtures;
/**
 * Description of ApiLeague
 *
 * @author dan
 */
class AppFixturesFactory {

    public static function create(){
        return new AppFixtures();
    }
}
