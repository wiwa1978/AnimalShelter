<?php

namespace App\Enums;


enum AnimalLocation: string
{
    case Albania = 'Albanië';
    case Netherlands = 'Nederland';
    case Germany = 'Duitland';
    case Belgium = 'België';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Albania => 'Albanië',
            self::Netherlands => 'Nederland',
            self::Germany => 'Duitland',
            self::Belgium => 'België',
        };
    }
}
