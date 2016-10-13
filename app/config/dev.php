<?php

use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Silex\Provider\HttpCacheServiceProvider;
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

$app->register(new HttpCacheServiceProvider(), [
    'http_cache.cache_dir' => sys_get_temp_dir() . '/app-http-cache/',
    'http_cache.esi' => null
]);

$app['http_cache.ttl'] = 10;
