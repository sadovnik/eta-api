<?php

namespace EtaApi;

/**
 * Represents a car on map.
 */
class Car
{
    /**
     * @var Point
     */
    private $location;

    /**
     * @var bool
     */
    private $available;

    /**
     * @param Point $location
     * @param bool $available
     */
    public function __construct(Point $location, $available)
    {
        $this->location = $location;
        $this->available = $available;
    }

    /**
     * @return Point
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return Point
     */
    public function getAvailable()
    {
        return $this->available;
    }
}
