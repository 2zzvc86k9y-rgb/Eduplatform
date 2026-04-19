<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'tmoney' => [
        'api_key' => env('TMONEY_API_KEY'),
        'api_secret' => env('TMONEY_API_SECRET'),
        'merchant_id' => env('TMONEY_MERCHANT_ID'),
        'environment' => env('TMONEY_ENVIRONMENT', 'sandbox'),
        'sandbox_url' => 'https://sandbox-api.tmoney.tg',
        'production_url' => 'https://api.tmoney.tg',
        'callback_url' => env('APP_URL') . '/tmoney/callback',
    ],

];
