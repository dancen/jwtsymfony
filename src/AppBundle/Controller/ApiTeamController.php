<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Controller\ApiErrorInterface;

class ApiTeamController extends Controller implements ApiErrorInterface {

    /**
     * getTeamAction 
     * 
     * get a team
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function getTeamAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $team_id = $request->get('team_id');

        if ((trim($team_id) != "") &&
                is_int($team_id)) {

            $manager = $this->get('app.api_team_manager');
            $team = $manager->getTeam($team_id);

            if ($team) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => $team)));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_FOUND)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    /**
     * getTeamsByLeagueAction 
     * 
     * get all teams by a league
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function getTeamsByLeagueAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $league_id = $request->get('league_id');

        if (is_string(trim($league_id)) &&
                is_int($league_id)) {

            $manager = $this->get('app.api_team_manager');
            $teams = $manager->getTeamsByLeague($league_id);

            if ($teams) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => $teams)));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_FOUND)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    /**
     * newTeamAction 
     * 
     * create new team
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function newTeamAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $league_id = $request->get('league_id');
        $team_name = $request->get('team_name');
        $team_strip = $request->get('team_strip');


        if ((trim($league_id) != "") &&
                (trim($team_name) != "") &&
                (trim($team_strip) != "") &&
                is_int($league_id)) {

            $manager = $this->get('app.api_team_manager');
            $team_id = $manager->createTeam($league_id, $team_name, $team_strip);

            if ($team_id) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => "TEAM ID " . $team_id . " CREATED SUCCESSFULLY")));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_CREATED)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    /**
     * updateTeamAction 
     * 
     * update a team
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function updateTeamAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());

        $team_id = $request->get('team_id');
        $league_id = $request->get('league_id');
        $team_name = $request->get('team_name');
        $team_strip = $request->get('team_strip');

        if ((trim($team_id) != "") &&
                (trim($league_id) != "") &&
                (trim($team_name) != "") &&
                (trim($team_strip) != "") &&
                is_int($team_id) &&
                is_int($league_id)) {


            $manager = $this->get('app.api_team_manager');
            $team_id = $manager->updateTeam($team_id, $league_id, $team_name, $team_strip);

            if ($team_id) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => "TEAM ID " . $team_id . " UPDATED SUCCESSFULLY")));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_CREATED)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    /**
     * deleteTeamAction 
     * 
     * delete a team
     *
     * @param Request $request    * 
     * @return JsonResponse
     */
    public function deleteTeamAction(Request $request) {
        $team_id = $request->get('team_id');

        if ((trim($team_id) != "") &&
                is_int($team_id)) {

            $manager = $this->get('app.api_team_manager');
            $team = $manager->deleteTeam($team_id);

            if ($team) {
                return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => json_decode($team, true))));
            } else {
                return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_CREATED)));
            }
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_VALID_PARAMS)));
        }
    }

    /**
     * getTeamsAction 
     * 
     * get all teams
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTeamsAction(Request $request) {

        $manager = $this->get('app.api_team_manager');
        $teams = $manager->getTeams();

        if ($teams) {
            return new JsonResponse(array("response" => array("code" => "200", "message" => "SUCCESS", "data" => $teams)));
        } else {
            return new JsonResponse(array("response" => array("code" => "400", "message" => "ERROR", "data" => ApiErrorInterface::ERROR_NOT_FOUND)));
        }
    }

}
