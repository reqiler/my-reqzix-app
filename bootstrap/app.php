<?php

session_start();

require __DIR__ . '/router.php';
require __DIR__ . '/middleware.php';

// current path
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// resolve route
$route = resolve_route($uri);

// middleware
handle_middleware($route);

// api response
if ($route['type'] === 'api') {
    require $route['file'];
    exit;
}

// render page
render($route);
