<?php

// config for Accordous/FcAnalise
return [
    /*
    |--------------------------------------------------------------------------
    | FC Análise API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your FC Análise API credentials and settings.
    |
    */

    'base_url' => env('FCANALISE_BASE_URL', 'https://api.fichacertadigital.com.br'),
    'login' => env('FCANALISE_LOGIN'),
    'password' => env('FCANALISE_PASSWORD'),
];
