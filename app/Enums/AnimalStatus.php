<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalStatus: string implements HasLabel
{
    case ADOPTED = 'Adopted';
    case AVAILABLE = 'Available';
    case RESERVED = 'Reserved';
    case PENDINGTREATMENT = 'Pending treatment';
    case NOTADOPTABLE = 'Not adoptable';


    public static function options(): array
    {
        return [
            self::ADOPTED->value => __('animals_back.adopted'),
            self::AVAILABLE->value => __('animals_back.available'),
            self::RESERVED->value => __('animals_back.reserved'),
            self::PENDINGTREATMENT->value => __('animals_back.pending_treatment'),
            self::NOTADOPTABLE->value => __('animals_back.not_adoptable'),
        ];
    }

    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

}
