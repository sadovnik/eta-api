<?php

use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use EtaApi\CarMongoRepository;

/** @var Silex\Application $app */
$app['debug'] = true;

$app->register(new DoctrineMongoDbProvider(), [
    'mongodb.options' => [
        'server' => 'mongodb://localhost:27017',
        'options' => [ 'db' => 'app' ]
    ]
]);

$app['repository.car'] = function ($app) {
    return new CarMongoRepository($app['mongodb']);
};
