<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalType: string implements HasLabel
{
    case Dog = 'Hond';
    case Cat = 'Kat';
    case Other = 'Ander huisdier';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Dog => 'Hond',
            self::Cat => 'Kat',
            self::Other => 'Ander huisdier',
        };
    }
}
