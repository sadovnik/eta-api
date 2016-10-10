<?php

/**
 * Exports a newly created instance of application
 *
 * @return Silex\Application
 */

use Silex\Application;

use Symfony\Component\HttpKernel\Exception\HttpException;

$app = new Application;

$app->error(function (\Exception $e) use ($app) {
    $statusCode = $e instanceof HttpException
        ? $e->getStatusCode()
        : 500;

    return $app->json([ 'error' => $e->getMessage() ], $statusCode);
});

return $app;
