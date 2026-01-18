<?php

function handle_middleware(array $route)
{
    if (
        isset($route['group']) &&
        $route['group'] === 'auth' &&
        !isset($_SESSION['user'])
    ) {
        header('Location: /');
        exit;
    }
}

function render(array $route)
{
    // extract dynamic params เช่น [id]
    if (isset($route['params'])) {
        extract($route['params']);
    }

    $contentFile = $route['file'];
    $layouts = [];

    // หา layout ซ้อนจากล่างขึ้นบน
    $dir = dirname($contentFile);
    while ($dir !== 'app') {
        if (file_exists($dir . '/layout.php')) {
            $layouts[] = $dir . '/layout.php';
        }
        $dir = dirname($dir);
    }

    $layouts = array_reverse($layouts);

    // render page
    ob_start();
    require $contentFile;
    $view = ob_get_clean();

    // wrap ด้วย layout
    foreach ($layouts as $layout) {
        ob_start();
        $content = $view;
        require $layout;
        $view = ob_get_clean();
    }

    echo $view;
}
