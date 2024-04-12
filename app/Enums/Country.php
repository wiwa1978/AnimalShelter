<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Country: string implements HasLabel
{
    case Netherlands = 'NL';
    case Belgium = 'BE';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Netherlands => 'Nederland',
            self::Belgium => 'Belgie',
        };
    }
}
