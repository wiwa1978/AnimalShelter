<?php

namespace App\Enums;

enum ApprovalState: string 
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
