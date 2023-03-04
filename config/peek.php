<?php 

return [
    'archival_period' => env('PEEK_ARCHIVAL_PERIOD', 14),
    'dark_mode' => env('PEEK_DARK_MODE', false),
    'domain' => env('PEEK_DASHBOARD_DOMAIN', null),
    'enabled' => env('PEEK_ENABLED', true),
    'ignore_paths' => [
        'horizon*',
        'telescope*',
        'nova*',
    ],
    'path' => env('PEEK_DASHBOARD_PATH', 'peek'),
    'middleware' => [
        'web',
    ],
    'model' => Brycedev\Peek\Models\RequestRecord::class,
];