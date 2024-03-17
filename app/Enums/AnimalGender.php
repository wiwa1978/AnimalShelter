<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalGender: string implements HasLabel
{
    case male = 'Mannelijk';
    case female = 'Vrouwelijk';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::male => 'Mannelijk',
            self::female => 'Vrouwelijk',
        };
    }
}
