<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Silex\Provider\HttpCacheServiceProvider;
use EtaApi\CarMongoRepository;

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

$app->register(new HttpCacheServiceProvider(), [
    'http_cache.cache_dir' => sys_get_temp_dir() . '/app-http-cache/',
    'http_cache.esi' => null
]);

$app['http_cache.ttl'] = 10;
