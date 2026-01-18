<?php
header('Content-Type: application/json');

echo json_encode([
    'users' => [
        ['id' => 1, 'name' => 'Alice'],
        ['id' => 2, 'name' => 'Bob']
    ]
]);
