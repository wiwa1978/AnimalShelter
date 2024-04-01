<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ApprovalState: string implements HasLabel
{
    case Approved = 'Goedgekeurd';
    case InReview = 'Wordt beoordeeld';
    case NotApproved = 'Afgekeurd';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Approved => 'Goedgekeurd',
            self::InReview => 'Wordt beoordeeld',
            self::NotApproved => 'Afgekeurd',
        };
    }
}
