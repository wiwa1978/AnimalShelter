<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalLocation: string implements HasLabel
{
    case Albania = 'Albanië';
    case Netherlands = 'Nederland';
    case Germany = 'Duitsland';
    case Belgium = 'België';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Albania => 'Albanië',
            self::Netherlands => 'Nederland',
            self::Germany => 'Duitsland',
            self::Belgium => 'België',
        };
    }
}
