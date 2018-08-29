<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\ApiErrorInterface;

class ApiLeagueController extends Controller implements ApiErrorInterface {

    
    
     /**
     * newLeagueAction 
     * 
     * create a new league
     *
     * @param Request $request     
     * @return JsonResponse
     */
    public function newLeagueAction(Request $request) {
        
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $league_name = $request->get('league_name');

        if ((trim($league_name) != "") && is_string($league_name)) {
            
            $manager = $this->get('app.api_league_manager');
            $league_id = $manager->createLeague($league_name);

            if ($league_id) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => "LEAGUE ID " . $league_id . " CREATED SUCCESSFULLY")));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_CREATED)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    
     /**
     * updateLeagueAction 
     * 
     * update a league
     *
     * @param Request $request   
     * @return JsonResponse
     */
    public function updateLeagueAction(Request $request) {
        
         $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $league_id = $request->get('league_id');
        $league_name = $request->get('league_name');

        if ((trim($league_id) != "") &&
               (trim($league_name) != "") && 
                  is_string($league_name)  && 
                    is_int($league_id)) {
            
            $manager = $this->get('app.api_league_manager');
            $result = $manager->updateLeague($league_id, $league_name);

            if ($result === true) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => "LEAGUE ID " . $league_id . " UPDATED SUCCESSFULLY")));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_UPDATED)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    
     /**
     * deleteLeagueAction 
     * 
     * delete a league
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function deleteLeagueAction(Request $request) {
                
         $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
        
        $league_id = $request->get('league_id');

        if ((trim($league_id) != "") && 
                    is_int($league_id)) {
            
            $manager = $this->get('app.api_league_manager');
            $result = $manager->deleteLeague($league_id);

            if ($result === true) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => "LEAGUE ID " . $league_id . " DELETED SUCCESSFULLY")));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_DELETED)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }
    
    
     /**
     * getLeagueAction 
     * 
     * get a league
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    
    public function getLeagueAction(Request $request) {
        
         $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
        
        $league_id = $request->get('league_id');

         if ((trim($league_id) != "") && 
                    is_int($league_id)) {
             
            $manager = $this->get('app.api_league_manager');
            $league = $manager->getLeague($league_id);

            if ($league) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => $league)));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_FOUND)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }
    

    
     /**
     * getLeaguesAction 
     * 
     * get all leagues
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function getLeaguesAction(Request $request) {

        $manager = $this->get('app.api_league_manager');
        $leagues = $manager->getLeagues();

        if ($leagues) {
            return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => $leagues)));
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_FOUND)));
        }
    }

}
