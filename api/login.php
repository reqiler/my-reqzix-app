<?php
session_start();

$_SESSION['user'] = [
    'id' => 1,
    'name' => 'Demo User'
];

header('Location: /');
exit;
