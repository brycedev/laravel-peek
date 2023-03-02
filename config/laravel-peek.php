<?php 

return [
    'domain' => env('PEEK_DASHBOARD_DOMAIN', null),
    'enabled' => env('PEEK_ENABLED', true),

    'ignore_paths' => [
        'horizon*',
        'telescope*',
        'nova*'
    ],

    'path' => env('PEEK_DASHBOARD_PATH', 'peek'),

    'middleware' => [
        'web',
        
    ],
];