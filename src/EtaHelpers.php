<?php

namespace EtaApi\EtaHelpers;

const EARTH_RADIUS = 6371000;

/**
 * Calculates distance of two given points using the haversine formula.
 *
 * @see https://en.wikipedia.org/wiki/Haversine_formula
 *
 * @param float $lon1
 * @param float $lat1
 * @param float $lon2
 * @param float $lat2
 *
 * @return integer distance in meters
 */
function getHaversineDistance($lon1, $lat1, $lon2, $lat2)
{
    $lat1Rad = deg2rad($lat1);
    $lat2Rad = deg2rad($lat2);

    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLon = deg2rad($lon2 - $lon1);

    $result =
        2 * EARTH_RADIUS *
        sqrt(
            pow(sin($deltaLat / 2), 2) +
            cos($lat1Rad) * cos($lat2Rad) * pow(sin($deltaLon / 2), 2)
        );

    return (int) $result;
}
