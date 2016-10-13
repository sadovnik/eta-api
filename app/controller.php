<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

use function EtaApi\EtaHelpers\haversineDistance;
use function EtaApi\EtaHelpers\eta;
use EtaApi\CarRepositoryInterface;
use EtaApi\Point;

/** @var Silex\Application $app */
$app->get('/eta', function (Request $request) use ($app) {
    $userLat = $request->query->get('lat');
    $userLon = $request->query->get('lon');

    if (!$userLat || !$userLon) {
        throw new UnprocessableEntityHttpException('Lat and lon parameters are required');
    }

    /** @var CarRepositoryInterface $carRepo */
    $carRepo = $app['repository.car'];

    $cars = $carRepo->findNearestAvailableCars(new Point($userLon, $userLat));

    if (count($cars) < 3) {
        return $app->json([ 'eta' => null ]);
    }

    $distances = array_map(
        function ($car) use ($userLon, $userLat) {
            return haversineDistance($userLon, $userLat, $car->getLocation()->getLon(), $car->getLocation()->getLat());
        },
        array_slice($cars, 0, 3)
    );

    list ($distance1, $distance2, $distance3) = $distances;

    $eta = eta($distance1, $distance2, $distance3);

    $response = new JsonResponse([ 'eta' => $eta ], 200);
    $response->setTtl($app['http_cache.ttl']);
    return $response;
});
