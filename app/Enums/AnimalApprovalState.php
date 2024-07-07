<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalApprovalState: string implements HasLabel
{
    case APPROVED = 'Approved';
    case INREVIEW = 'InReview';
    case NOTAPPROVED = 'NotApproved';

    case NOTAPPLICABLE = 'NotApplicable';

    
    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::APPROVED->value => __('animals_back.approved'),
            self::INREVIEW->value => __('animals_back.inreview'),
            self::NOTAPPROVED->value => __('animals_back.notapproved'),
            self::NOTAPPLICABLE->value => __('animals_back.notapplicable'),
        ];
    }

}
