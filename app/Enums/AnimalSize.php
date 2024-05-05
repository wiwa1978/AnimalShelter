<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalSize: string implements HasLabel
{
    case SMALL = 'Small';
    case MEDIUM = 'Medium';
    case LARGE = 'Large';
    case VERYLARGE = 'Very large';

    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::SMALL->value => __('animals_back.small'),
            self::MEDIUM->value => __('animals_back.medium'),
            self::LARGE->value => __('animals_back.large'),
            self::VERYLARGE->value => __('animals_back.verylarge'),
        ];
    }


    // public function getLabel(): ?string
    // {
    //     return match ($this) {
    //         self::small => 'Klein',
    //         self::medium => 'Medium',
    //         self::large => 'Groot',
    //         self::verylarge => 'Zeer groot',
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
