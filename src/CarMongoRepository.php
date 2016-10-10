<?php

namespace EtaApi;

use EtaApi\Point;
use EtaApi\Car;
use Doctrine\MongoDB;

class CarMongoRepository implements CarRepositoryInterface
{
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
        $rawCars = $this->mongodb
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
                        '$maxDistance' => 0.1
                    ]
                ]
            ]);

        $cars = [];

        foreach ($rawCars as $rawCar) {
            list ($lon, $lat) = $rawCar['location'];
            $point = new Point($lon, $lat);
            $cars []= new Car($point, $rawCar['available']);
        }

        return $cars;
    }
}
