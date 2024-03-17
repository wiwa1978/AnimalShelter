<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalSize: string implements HasLabel
{
    case small = 'Klein';
    case medium = 'Medium';
    case large = 'Groot';
    case verylarge = 'Zeer groot';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::small => 'Klein',
            self::medium => 'Medium',
            self::large => 'Groot',
            self::verylarge => 'Zeer groot',
        };
    }
}
