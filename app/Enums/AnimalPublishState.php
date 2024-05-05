<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalPublishState: string implements HasLabel
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case UNPUBLISHED = 'Unpublished';


    public static function options(): array
    {
        return [
            self::DRAFT->value => __('animals_back.draft'),
            self::PUBLISHED->value => __('animals_back.published'),
            self::UNPUBLISHED->value => __('animals_back.unpublished'),
        ];
    }
    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    // public function getLabel(): ?string
    // {
    //     return match ($this) {
    //         self::Draft => 'Draft',
    //         self::Published => 'Gepubliceerd',
    //         self::Unpublished => 'Niet gepubliceerd',
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
