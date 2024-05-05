<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalLocation: string implements HasLabel
{
    case ALBANIA = 'Albania';
    case NETHERLANDS = 'Netherlands';
    case GERMANY = 'Germany';
    case BELGIUM = 'Belgium';


    public static function options(): array
    {
        return [
            self::ALBANIA->value => __('animals_back.albania'),
            self::NETHERLANDS->value => __('animals_back.netherlands'),
            self::GERMANY->value => __('animals_back.germany'),
            self::BELGIUM->value => __('animals_back.belgium'),
        ];
    }

    
    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

}
