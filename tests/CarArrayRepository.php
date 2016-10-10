<?php

namespace EtaApi\Tests;

use EtaApi\CarRepositoryInterface;
use EtaApi\Point;

class CarArrayRepository implements CarRepositoryInterface
{
    private $cars;

    public function __construct($cars)
    {
        $this->cars = $cars;
    }

    public function findNearestAvailableCars(Point $point)
    {
        return $this->cars;
    }
}
