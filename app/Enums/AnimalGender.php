<?php

namespace App\Enums;



enum AnimalGender: string 
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
