<?php

use Illuminate\Support\Facades\Auth;

return [

    'resources' => [
        'AutenticationLogResource' => \Tapp\FilamentAuthenticationLog\Resources\AuthenticationLogResource::class,
    ],

    'authenticable-resources' => [
        \App\Models\User::class,
    ],

    'authenticatable' => [
        'field-to-display' => 'name',
    ],

    'navigation' => [
        'authentication-log' => [
            'register' => true,
            'sort' => 1,
            'icon' => 'heroicon-o-shield-exclamation',
        ],
    ],

    'sort' => [
        'column' => 'login_at',
        'direction' => 'desc',
    ],
];
