<?php

namespace AppBundle\Manager;



/**
 * AppBundle\Manager\ApiManager
 *
 * @author dan
 */
abstract class ApiManager {
        

    // $em
    protected $em;


    /**
     * Returns the entity repository
     *
     * @param  String 
     * @return EntityRepository 
     */
    protected function getRepo($class) {
        return $this->em->getRepository($class);
    }
    
   
    

}
