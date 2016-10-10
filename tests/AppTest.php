<?php

namespace EtaApi\Tests;

use Silex\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use EtaApi\Point;
use EtaApi\Car;

class AppTest extends WebTestCase
{
    public function createApplication()
    {
        $root = dirname(__DIR__);
        $app = require $root . '/app/app.php';
        require $root . '/app/config/test.php';
        require $root . '/app/controller.php';
        $app['repository.car'] = function () {
            return new CarArrayRepository([
                new Car(
                    new Point(37.60258, 55.762149),
                    true
                ),
                new Car(
                    new Point(37.60861, 55.76192),
                    true
                ),
                new Car(
                    new Point(37.607601, 55.752647),
                    true
                ),
            ]);
        };
        return $app;
    }

    public function testNormalFlow()
    {
        $client = $this->createClient();

        $client->request('GET', '/eta?lat=55.757766&lon=37.595824');

        $response = $client->getResponse();
        $this->assertTrue($response->isOk());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertContains('eta', $response->getContent());
    }

    public function testErrorFlow()
    {
        $client = $this->createClient();

        $client->request('GET', '/eta?lon=37.595824');

        $response = $client->getResponse();
        $this->assertFalse($response->isOk());
        $this->assertContains('error', $response->getContent());
        $this->assertEquals(422, $response->getStatusCode());
    }
}
