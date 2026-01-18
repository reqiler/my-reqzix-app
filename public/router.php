<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// ถ้าเป็นไฟล์จริง (css, js, image) ให้เสิร์ฟตรง
if ($path !== '/' && file_exists($file)) {
    return false;
}

// ทุกอย่างที่เหลือ → index.php
require __DIR__ . '/index.php';
