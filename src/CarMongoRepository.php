<?php

namespace EtaApi;

use EtaApi\Point;
use EtaApi\Car;
use Doctrine\MongoDB;

class CarMongoRepository implements CarRepositoryInterface
{
    /**
     * @var float max radius distance in radians
     */
    const MAX_DISTANCE = 0.1;

    /**
     * @var DoctrineMongoDbProvider
     */
    public $mongodb;

    /**
     * @param Doctrine\MongoDB\Connection $mongodb
     */
    public function __construct(MongoDB\Connection $mongodb)
    {
        $this->mongodb = $mongodb;
    }

    /**
     * @inheritdoc
     */
    public function findNearestAvailableCars(Point $point)
    {
        $rawCars = $this->makeQuery($point);

        $cars = [];

        foreach ($rawCars as $rawCar) {
            list ($lon, $lat) = $rawCar['location'];
            $point = new Point($lon, $lat);
            $cars []= new Car($point, $rawCar['available']);
        }

        return $cars;
    }

    /**
     * Makes mongodb query.
     *
     * @param Point $point
     * @return \Iterator
     */
    protected function makeQuery(Point $point)
    {
        return $this->mongodb
            ->selectDatabase('app')
            ->selectCollection('cars')
            ->find([
                'available' => true,
                'location' => [
                    '$near' => [
                        '$geometry' => [
                            'type' => 'Point' ,
                            'coordinates' => $point->asArray()
                        ],
                        '$maxDistance' => self::MAX_DISTANCE
                    ]
                ]
            ]);
    }
}
