<?php

use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use EtaApi\CarMongoRepository;

/** @var Silex\Application $app */
$app['debug'] = true;

$app['mongodb.default_db'] = 'app';
$app->register(new DoctrineMongoDbProvider(), [
    'mongodb.options' => [ 'server' => 'mongodb://localhost:27017' ]
]);

$app['repository.car'] = function ($app) {
    return new CarMongoRepository($app['mongodb'], $app['mongodb.default_db']);
};
