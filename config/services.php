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

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'http://localhost:8000/login/callback/github',
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => 'http://localhost:8000/login/callback/google',
    ],
    // 'facebook' => [
    //     'client_id' => '1176863346518239',
    //     'client_secret' => 'cbf32ffc595344e27f54822e9be97dbc',
    //     'redirect' => 'http://localhost:8000/login/facebook/callback',
    // ],
    // 'facebook' => [
    //     'client_id' => '234822038606529',
    //     'client_secret' => 'adc0029e11ccfa7d0b6eca1a9e5d34b3',
    //     'redirect' => 'http://localhost:8000/login/callback/facebook',
    // ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => 'https://myportfolio-346808.web.app/login/callback/facebook',
        // 'redirect' => 'http://localhost:8000/login/callback/facebook',
    ],

  

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
