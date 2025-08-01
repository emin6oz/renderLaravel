<?php
return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout'],

    'allowed_methods' => ['*'],

    // 'allowed_origins' => explode(',', env('FRONTEND_URL', 'http://localhost:5173')),
    'allowed_origins' => ['http://localhost:5173', 'https://dreamscape-5asf.onrender.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];

