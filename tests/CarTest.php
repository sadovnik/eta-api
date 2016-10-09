<?php

namespace EtaApi\Tests;

use PHPUnit\Framework\TestCase;

use EtaApi\Point;
use EtaApi\Car;

class CarTest extends TestCase
{
    public function testGetLocation()
    {
        $location = new Point(1, 2);
        $car = new Car($location, true);
        $this->assertEquals($location, $car->getLocation());
    }

    public function testGetAvailable()
    {
        $location = new Point(1, 2);
        $car = new Car($location, true);
        $this->assertTrue($car->getAvailable());

        $car = new Car($location, false);
        $this->assertFalse($car->getAvailable());
    }
}
