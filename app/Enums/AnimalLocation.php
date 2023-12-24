<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalLocation: string implements HasLabel
{
    case Albania = 'Albania';
    case Netherlands = 'Netherlands';
    case Germany = 'Germany';
    case Belgium = 'Belgium';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Albania => 'Albania',
            self::Netherlands => 'The Netherlands',
            self::Germany => 'Germany',
            self::Belgium => 'Belgium',
        };
    }
}
