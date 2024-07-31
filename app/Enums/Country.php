<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Country: string implements HasLabel
{
    case NETHERLAND = 'Netherlands';
    case BELGIUM = 'Belgium';

    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::NETHERLAND->value => 'Nederland',
            self::BELGIUM->value => 'België',
        ];
    }
}
