<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalAdoptionFee: string implements HasLabel
{
    case SMALLER_THAN_100_EUR = '<100 EUR';
    case BETWEEN_100_AND_250_EUR = '100 - 250 EUR';
    case BETWEEN_250_AND_500_EUR = '250 - 500 EUR';
    case BETWEEN_500_AND_1000_EUR = '500 - 1000 EUR';
    case BETWEEN_1000_AND_2000_EUR = '1000 - 2000 EUR';
    case LARGER_THAN_2000_EUR = '> 2000 EUR';

    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::SMALLER_THAN_100_EUR->value => '<100 EUR',
            self::BETWEEN_100_AND_250_EUR->value => '100 - 250 EUR',
            self::BETWEEN_250_AND_500_EUR->value => '250 - 500 EUR',
            self::BETWEEN_500_AND_1000_EUR->value => '500 - 1000 EUR',
            self::BETWEEN_1000_AND_2000_EUR->value => '1000 - 2000 EUR',
            self::LARGER_THAN_2000_EUR->value => '> 2000 EUR',
        ];
    }
}
