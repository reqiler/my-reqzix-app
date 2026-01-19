<?php

return [
    'GET' => function () {
        return [
            'users' => [
                ['id' => 1, 'name' => 'Alice'],
                ['id' => 2, 'name' => 'Bob'],
            ],
        ];
    },

    // 'POST' => function () {
    //     // อ่าน JSON body
    //     $raw = file_get_contents('php://input');
    //     $body = json_decode($raw, true) ?? [];

    //     // ตัวอย่าง validate ง่ายๆ
    //     if (!isset($body['name']) || $body['name'] === '') {
    //         return ['error' => 'name is required'];
    //     }

    //     return [
    //         'created' => true,
    //         'user' => ['id' => 3, 'name' => (string)$body['name']],
    //     ];
    // },
];
