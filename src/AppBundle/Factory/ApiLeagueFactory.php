<?php

namespace AppBundle\Factory;

use AppBundle\Entity\ApiLeague;
/**
 * Description of ApiLeague
 *
 * @author dan
 */
class ApiLeagueFactory {

    public static function create(){
        return new ApiLeague();
    }
}
