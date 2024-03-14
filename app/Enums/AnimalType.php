<?php

namespace App\Enums;



enum AnimalType: string 
{
    case Dog = 'Hond';
    case Cat = 'Kat';
    case Other = 'Andere';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Dog => 'Hond',
            self::Cat => 'Kat',
            self::Other => 'Andere',
        };
    }
}
