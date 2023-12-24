<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalGender: string implements HasLabel
{
    case male = 'Male';
    case female = 'Female';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::male => 'Male',
            self::female => 'Female',
        };
    }
}
