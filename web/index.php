<?php

require_once __DIR__ . '/../vendor/autoload.php';

/** @var Silex\Application */
$app = require __DIR__ . '/../app/app.php';

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

$debug = true;

ErrorHandler::register();
ExceptionHandler::register($debug);

$app['debug'] = $debug;
$app->run();
