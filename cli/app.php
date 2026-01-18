<?php

$cmd = $argv[1] ?? null;

if ($cmd === 'dev') {
    passthru('php -S localhost:8000 public/router.php');
} else {
    echo "Usage: php cli/app.php dev\n";
}
