<?php

return [
    'callback' => 'http://localhost:8080/hybridauth.php',
    'providers' => [
        'Google' => [
            'enabled' => true, 
            'keys' => [
                'id' => '...', 
                'secret' => '...'
            ],
            "includedEmail" => true
        ],
        'Facebook' => [
            'enabled' => true,
            'keys' => [
                'id' => '...',
                'secret' => '...'
            ]
        ]
    ]
];
