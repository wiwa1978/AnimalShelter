<?php

use App\Models\User;
use App\Filament\App\Resources\TicketResource;

return [
    'user-model' => User::class,

    // You can extend the package's TicketResource to customize to your needs.
    //'ticket-resource' => TicketResource::class,

    // whether a ticket must be strictly interacted with another model
    'is_strictly_interacted' => false,

    // filament navigation
    'navigation' => [
        'group' => 'Tickets',
        'sort' => 1,
    ],

    // ticket statuses
    'statuses' => [
        1 => 'Open',
        2 => 'In behandeling',
        3 => 'Opgelost',
        4 => 'Gesloten',
    ],

    // ticket priorities
    'priorities' => [
        1 => 'Laag',
        2 => 'Normaal',
        3 => 'Hoog',
        4 => 'Kritisch',
    ],

    // use authorization
    'use_authorization' => true,

    // event broadcast channel
    'event_broadcast_channel' => 'ticket-channel',
];