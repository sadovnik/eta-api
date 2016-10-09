<?php

namespace EtaApi;

/**
 * Represents a point on map.
 */
class Point
{
    /**
     * @var float
     */
    private $lon;

    /**
     * @var float
     */
    private $lat;

    /**
     * @param float $lon the longitude
     * @param float $lat the latitude
     */
    public function __construct($lon, $lat)
    {
        $this->lon = $lon;
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Returns array representation of point.
     *
     * @return array
     */
    public function asArray()
    {
        return [ $this->lon, $this->lat ];
    }
}
