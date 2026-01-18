<?php

$cmd = $argv[1] ?? null;

if ($cmd === 'dev') {
    echo "\n";
    echo "  Reqziel Dev Server\n";
    echo "  Local: http://localhost:8000\n\n";

    passthru('php -S localhost:8000 -q public/router.dev.php');
    exit;
}

echo "\nUsage:\n";
echo "  reqziel dev\n";
