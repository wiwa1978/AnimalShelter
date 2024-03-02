<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalType: string implements HasLabel
{
    case Dog = 'Dog';
    case Cat = 'Cat';
    case Other = 'Other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Dog => 'Dog',
            self::Cat => 'Cat',
            self::Other => 'Other',
        };
    }
}
