<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalAge: string implements HasLabel
{
    case ZERO_TO_ONE_YEAR = '0-1';
    case ONE_TO_TWO_YEARS = '1-2';
    case TWO_TO_THREE_YEARS = '2-3';
    case THREE_TO_FOUR_YEARS = '3-4';
    case FOUR_TO_FIVE_YEARS = '4-5';
    case FIVE_TO_SIX_YEARS = '5-6';
    case SIX_TO_SEVEN_YEARS = '6-7';
    case SEVEN_TO_EIGHT_YEARS = '7-8';
    case EIGHT_TO_NINE_YEARS = '8-9';
    case NINE_TO_TEN_YEARS = '9-10';
    case OLDER_THAN_TEN_YEARS = '> 10';
    case OLDER_THAN_FIFTEEN_YEARS = '> 15';


    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::ZERO_TO_ONE_YEAR->value =>  __('animals_back.zero_to_one_year'),
            self::ONE_TO_TWO_YEARS->value =>  __('animals_back.one_to_two_years'),
            self::TWO_TO_THREE_YEARS->value =>  __('animals_back.two_to_three_years'),
            self::THREE_TO_FOUR_YEARS->value =>  __('animals_back.three_to_four_years'),
            self::FOUR_TO_FIVE_YEARS->value =>  __('animals_back.four_to_five_years'),
            self::FIVE_TO_SIX_YEARS->value =>  __('animals_back.five_to_six_years'),
            self::SIX_TO_SEVEN_YEARS->value =>  __('animals_back.six_to_seven_years'),
            self::SEVEN_TO_EIGHT_YEARS->value =>  __('animals_back.seven_to_eight_years'),
            self::EIGHT_TO_NINE_YEARS->value =>  __('animals_back.eight_to_nine_years'),
            self::NINE_TO_TEN_YEARS->value =>  __('animals_back.nine_to_ten_years'),
            self::OLDER_THAN_TEN_YEARS->value =>  __('animals_back.older_than_ten_years'),
            self::OLDER_THAN_FIFTEEN_YEARS->value =>  __('animals_back.older_than_fifteen_years')
        ];
    }



    // public function getLabel(): ?string
    // {
    //     return match ($this) {
    //         self::ZERO_TO_ONE_YEAR => '0-1 jaar',
    //         self::ONE_TO_TWO_YEARS => '1-2 jaar',
    //         self::TWO_TO_THREE_YEARS => '2-3 jaar',
    //         self::THREE_TO_FOUR_YEARS => '3-4 jaar',
    //         self::FOUR_TO_FIVE_YEARS => '4-5 jaar',
    //         self::FIVE_TO_SIX_YEARS => '5-6 jaar',
    //         self::SIX_TO_SEVEN_YEARS => '6-7 jaar',
    //         self::SEVEN_TO_EIGHT_YEARS => '7-8 jaar',
    //         self::EIGHT_TO_NINE_YEARS => '8-9 jaar',
    //         self::NINE_TO_TEN_YEARS => '9-10 jaar',
    //         self::OLDER_THAN_TEN_YEARS => 'ouder dan 10 jaar',
    //         self::OLDER_THAN_FIFTEEN_YEARS => 'ouder dan 15 jaar'
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
