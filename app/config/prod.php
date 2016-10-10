<?php

use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

/** @var Silex\Application $app */
$app['mongodb.default_db'] = getenv('MONGO_DB');
$app->register(new DoctrineMongoDbProvider(), [
    'mongodb.options' => [
        'server' => getenv('MONGO_SERVER'),
        'options' => [
            'username' => getenv('MONGO_USER'),
            'password' => getenv('MONGO_PASSWORD'),
            'db' => getenv('MONGO_DB')
        ]
    ]
]);

$app['repository.car'] = function ($app) {
    return new CarMongoRepository($app['mongodb'], $app['mongodb.default_db']);
};
