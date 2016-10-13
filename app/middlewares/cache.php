<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds http caching on successful get response.
 *
 * @see http://silex.sensiolabs.org/doc/providers/http_cache.html
 */
$app->after(function (Request $request, Response $response) use (&$app) {
    if ($request->getMethod() === Request::METHOD_GET && $response->isOk()) {
        $response->setTtl($app['http_cache.ttl']);
        return $response;
    } else {
        return $response;
    }
});
