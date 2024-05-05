<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Country: string implements HasLabel
{
    case NETHERLANDS = 'NL';
    case BELGIUM = 'BE';

    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::NETHERLANDS->value => 'NL',
            self::BELGIUM->value => 'BE',
        ];
    }
}
