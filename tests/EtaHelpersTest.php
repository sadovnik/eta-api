<?php

namespace EtaApi\Tests;

use PHPUnit\Framework\TestCase;
use function EtaApi\EtaHelpers\getHaversineDistance;
use function EtaApi\EtaHelpers\getEta;

class EtaHelpersTest extends TestCase
{
    /**
     * @dataProvider provideGetHaversineDistanceData
     */
    public function testGetHaversineDistance($coordinates, $expected)
    {
        list ($lonFrom, $latFrom, $lonTo, $latTo) = $coordinates;
        $result = getHaversineDistance($lonFrom, $latFrom, $lonTo, $latTo);
        $this->assertEquals($expected, $result);
    }

    public function provideGetHaversineDistanceData()
    {
        return [
            [ [ 37.629847, 55.756457, 37.632851, 55.753214 ], 406 ],
            [ [ 37.6173, 55.7558, 30.7233, 46.4825 ], 1135060 ],
            [ [ 30.7233, 46.4825, 37.6173, 55.7558 ], 1135060 ],
            [ [ 30.7233, 46.4825, 30.7233, 46.4825 ], 0 ]
        ];
    }

    public function testGetEta()
    {
        $expected = 2;
        $actual = getEta(100, 150, 200);
        $this->assertEquals($expected, $actual);
    }
}
