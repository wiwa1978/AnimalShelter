<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ApprovalState: string implements HasLabel
{
    case Approved = 'Approved';
    case InReview = 'InReview';
    case NotApproved = 'NotApproved';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Approved => 'Approved',
            self::InReview => 'InReview',
            self::NotApproved => 'NotApproved',
        };
    }
}
