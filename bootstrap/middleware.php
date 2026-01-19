<?php

function handle_middleware(array $route)
{
    $groups = $route['groups'] ?? [];

    // if (in_array('auth', $groups, true) && !isset($_SESSION['user'])) {
    //     header('Location: /');
    //     exit;
    // }

    // if (in_array('admin', $groups, true)) {
    //     $role = $_SESSION['user']['role'] ?? null;
    //     if ($role !== 'admin') {
    //         http_response_code(403);
    //         exit('403 Forbidden');
    //     }
    // }
}

function render(array $route)
{
    if (isset($route['params'])) {
        extract($route['params'], EXTR_SKIP);
    }

    // ✅ ให้มี metadata เสมอ
    $metadata = [];

    ob_start();
    require $route['file'];
    $view = ob_get_clean();

    $layouts = $route['layouts'] ?? []; // closest -> root (ของคุณถูกแล้ว)

    foreach ($layouts as $layout) {
        ob_start();
        $content = $view;
        require $layout;   // ✅ layout จะเห็น $metadata, $content
        $view = ob_get_clean();
    }

    echo $view;
}
