<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Factory\AppFixturesFactory;

class ApiTeamControllerTest extends WebTestCase {

    protected function setUp() {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $fixture = AppFixturesFactory::create();
        $fixture->load($entityManager);
    }

  
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $username
     * @param string $password
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    private function createAuthenticatedClient($username = 'jamie_vardy', $password = 'jamie_vardy_pass') {
        $client = static::createClient();
        $client->request(
                'POST', '/api/login_check', array(
                'username' => $username,
                'password' => $password,
                )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testGetTeam() {

        $param = array(
            "team_id" => 15
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/team', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testGetTeams() {

        $param = array();

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/teams', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testGetTeamsByLeague() {

        $param = array(
            "league_id" => 2
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/teamsbyleague', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testCreateTeam() {

        $param = array(
            "league_id" => 3,
            "team_name" => "Europa",
            "team_strip" => "34"
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/newteam', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testUpdateTeam() {

        $param = array(
            "team_id" => 12,
            "league_id" => 3,
            "team_name" => "Europa3",
            "team_strip" => "32"
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/updateteam', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testDeleteTeam() {

        $param = array(
            "team_id" => 10,
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/deleteteam', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

}
