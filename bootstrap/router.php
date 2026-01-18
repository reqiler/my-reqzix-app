<?php

function resolve_route(string $uri): array
{
    // ---------- API ----------
    if (strpos($uri, 'api/') === 0) {
        $file = 'api/' . substr($uri, 4) . '.php';
        if (file_exists($file)) {
            return [
                'type' => 'api',
                'file' => $file,
            ];
        }

        http_response_code(404);
        exit('API Not Found');
    }

    $segments = $uri === '' ? [] : explode('/', $uri);

    // 1) public routes
    $route = match_route('app', $segments);
    if ($route) {
        return $route;
    }

    // 2) auth group
    $route = match_route('app/(auth)', $segments);
    if ($route) {
        $route['group'] = 'auth';
        return $route;
    }

    // ❌ NO FALLBACK
    http_response_code(404);
    exit('404 Not Found');
}

function match_route(string $base, array $segments): ?array
{
    $params = [];
    $path = $base;

    foreach ($segments as $seg) {
        if (is_dir($path . '/' . $seg)) {
            $path .= '/' . $seg;
        } else {
            $matched = false;
            foreach (glob($path . '/[[]*[]]') as $dyn) {
                $key = trim(basename($dyn), '[]');
                $params[$key] = $seg;
                $path = $dyn;
                $matched = true;
                break;
            }
            if (!$matched) {
                return null; // ❗ ตรงนี้สำคัญ
            }
        }
    }

    $page = $path . '/page.php';

    if (file_exists($page)) {
        return [
            'type'   => 'page',
            'file'   => $page,
            'params' => $params,
            'group'  => 'public',
        ];
    }

    return null;
}
