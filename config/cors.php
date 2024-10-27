<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // APIと認証用のパス

    'allowed_methods' => ['*'], // 許可するHTTPメソッド

    'allowed_origins' => ['http://localhost:3000'], // フロントエンドのURLを指定

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // 許可するHTTPヘッダー

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // 認証情報を含むリクエストを許可
];
