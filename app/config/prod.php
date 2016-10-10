<?php

use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;

/** @var Silex\Application $app */
$app->register(new DoctrineMongoDbProvider(), [
    'mongodb.options' => [ 'server' => 'mongodb://localhost:27017' ]
]);
