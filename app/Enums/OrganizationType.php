<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OrganizationType: string implements HasLabel
{
    case INDIVIDUAL = 'Individual';
    case ORGANIZATION = 'Organization';
    case SHELTER = 'Shelter';


    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::INDIVIDUAL->value => __('animals_back.individual'),
            self::ORGANIZATION->value => __('animals_back.organization'),
            self::SHELTER->value => __('animals_back.shelter'),
        ];
    }

   
}
