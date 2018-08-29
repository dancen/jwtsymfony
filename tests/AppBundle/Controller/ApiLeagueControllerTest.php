<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Factory\AppFixturesFactory;

class ApiLeagueControllerTest extends WebTestCase {

   

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

    public function testGetLeague() {

        $param = array(
            "league_id" => 3
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/league', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testCreateLeague() {

        $param = array(
            "league_name" => "Europa3",
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/newleague', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testUpdateLeague() {

        $param = array(
            "league_id" => 2,
            "league_name" => "Europa6"
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/updateleague', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

    public function testDeleteLeague() {

        $param = array(
            "league_id" => 2,
        );

        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/1.0/deleteleague', $param, array(), array("Content-type" => "application/json"));
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertRegexp('/200/', $response->getContent());
    }

}
