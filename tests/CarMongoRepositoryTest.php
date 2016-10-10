<?php

namespace EtaApi\Tests;

use PHPUnit\Framework\TestCase;

use EtaApi\Point;
use EtaApi\Car;
use EtaApi\CarMongoRepository;

class CarMongoRepositoryTest extends TestCase
{
    public function testFindNearestAvailableCarsFactory()
    {
        $repo = $this->getMockBuilder(CarMongoRepository::class)
            ->disableOriginalConstructor()
            ->setMethods([ 'makeQuery' ])
            ->getMock();

        $rawCars = [
            [
                'available' => true,
                'location' => [ 37.6173, 55.7558 ]
            ],
            [
                'available' => true,
                'location' => [ 37.632851, 55.753214 ]
            ],
        ];

        $repo
            ->expects($this->once())
            ->method('makeQuery')
            ->will($this->returnValue($rawCars));

        $actual = $repo->findNearestAvailableCars(new Point(30.7233, 46.4825));

        $expected = [
            new Car(
                new Point(37.6173, 55.7558),
                true
            ),
            new Car(
                new Point(37.632851, 55.753214),
                true
            )
        ];

        $this->assertEquals($expected, $actual);
    }
}
