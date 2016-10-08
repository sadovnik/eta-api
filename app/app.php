<?php

/**
 * Exports a newly created instance of application
 *
 * @return Silex\Application
 */

use Silex\Application;
use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Symfony\Component\HttpFoundation\Request;

$app = new Application;

$app->register(new DoctrineMongoDbProvider(), [
    'mongodb.options' => [ 'server' => 'mongodb://localhost:27017' ]
]);

$app->get('/', function (Request $request) use ($app) {
    return $app->json([
        'hello' => 'there',
        'params' => $request->query->all()
    ]);
});

return $app;
