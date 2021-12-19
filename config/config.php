<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'enable' => env('SOCIAL_AUTH', false),
    'providers' => explode('|', env('SOCIAL_AUTH_PROVIDERS', 'github|facebook|google|twitter')),
    'route' => env('SOCIAL_AUTH_ROUTE', '/auth/social'),
    'callback' => env('SOCIAL_AUTH_CALLBACK', '/auth/social/callback'),
    'user_model' => \App\Models\User::class
];
