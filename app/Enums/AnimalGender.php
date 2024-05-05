<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalGender: string implements HasLabel
{
    case MALE = 'Male';
    case FEMALE = 'Female';


    public static function options(): array
    {
        return [
            self::MALE->value => __('animals_back.male'),
            self::FEMALE->value => __('animals_back.female'),
    
        ];
    }

    
    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    // public function getLabel(): ?string
    // {
    //     return match ($this) {
    //         self::male => 'Mannelijk',
    //         self::female => 'Vrouwelijk',
    //     };
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
