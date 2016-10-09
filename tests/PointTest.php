<?php

namespace EtaApi\Tests;

use PHPUnit\Framework\TestCase;

use EtaApi\Point;

class PointTest extends TestCase
{
    public $point;

    public function setUp()
    {
        $this->point = new Point(1, 2);
    }

    public function testGetLon()
    {
        $this->assertEquals(1, $this->point->getLon());
    }

    public function testGetLat()
    {
        $this->assertEquals(2, $this->point->getLat());
    }

    public function testAsArray()
    {
        $this->assertEquals([ 1, 2 ], $this->point->asArray());
    }
}
