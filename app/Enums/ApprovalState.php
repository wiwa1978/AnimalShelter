<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ApprovalState: string implements HasLabel
{
    case Approved = 'Goedgekeurd';
    case InReview = 'In behandeling';
    case NotApproved = 'Afgekeurd';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Approved => 'Goedgekeurd',
            self::InReview => 'In behandeling',
            self::NotApproved => 'Afgekeurd',
        };
    }
}
