<?php

require_once __DIR__ . '/../vendor/autoload.php';

/** @var Silex\Application $app */
$app = require __DIR__ . '/../app/app.php';

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

ErrorHandler::register();

if (getenv('APP_ENV') === 'dev') {
    ExceptionHandler::register();
    require __DIR__ . '/../app/config/dev.php';
} else {
    require __DIR__ . '/../app/config/prod.php';
}

require __DIR__ . '/../app/controller.php';

$app['http_cache']->run();
