<?php

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $route) {
    require __DIR__ . '/routes.php';
}, [
    'cacheFile' => __DIR__ . '/../cache/route.cache',
    'cacheDisabled' => getenv('APP_ENV') === 'prod' ? false : true
]);

// Fetch method and URI
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header('404 Not Found', true, 404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        header('405 Method Not Allowed', true, 405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // Build request object
        $request = new Symfony\Component\HttpFoundation\Request(
            $vars,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );

        // Actual call to the controller action
        $callback = function($request, $response) use ($handler) {
            list($class, $method) = explode('/', $handler, 2);

            return (new $class)->$method($request, $response);
        };

        if (strpos($request->getUri(), getenv('API_PREFIX')) !== false) { 
            $response = $callback($request, new Symfony\Component\HttpFoundation\JsonResponse); 
            return $response->send(); 
        } else { 
            $response = $callback($request, new Symfony\Component\HttpFoundation\Response); return $response; 
        }

        return $response->send();
}