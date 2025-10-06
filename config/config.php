<?php
// Application configuration
return [
    'db' => [
        'host' => getenv('APP_DB_HOST') ?: '127.0.0.1',
        'port' => getenv('APP_DB_PORT') ?: '3306',
        'name' => getenv('APP_DB_NAME') ?: 'gujarati_billing',
        'user' => getenv('APP_DB_USER') ?: 'root',
        'pass' => getenv('APP_DB_PASS') ?: '',
        'charset' => 'utf8mb4',
    ],
    'app' => [
        'title' => 'ગુજરાતી બિલિંગ અને રિપોર્ટિંગ',
        'base_url' => '', // If hosted under a subpath, set it here
        'locale' => 'gu',
    ],
];
