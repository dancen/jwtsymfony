<?php

namespace AppBundle\Factory;

use AppBundle\Entity\ApiTeam;
/**
 * Description of ApiTeam
 *
 * @author dan
 */
class ApiTeamFactory {

    public static function create(){
        return new ApiTeam();
    }
}
