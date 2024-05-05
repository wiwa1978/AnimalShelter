<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalType: string implements HasLabel
{
    case DOG = 'Dog';
    case CAT = 'Cat';
    case OTHER = 'Other';


    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::DOG->value => __('animals_back.dog'),
            self::CAT->value => __('animals_back.cat'),
            self::OTHER->value => __('animals_back.other'),
        ];
    }

    // public function getLabel(): ?string
    // {
    //     return match ($this) {
    //         self::DOG => 'Hond',
    //         self::CAT => 'Kat',
    //         self::OTHER => 'Ander huisdier',
    //     };
    // }

    // public static function values(): array
    // {
    //     return array_column(self::cases(), 'name', 'value');
    // }
    
    // public static function toArray(): array
    // {
    //     $array = [];
    //     foreach (self::cases() as $index => $case) {
    //         $array[$index] = $case->getLabel();
    //     }
    //     return $array;
    // }
}
