<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum VoucherDiscounts: string implements HasLabel
{
    case ten_percent = '10 percent discount';
    case fifty_percent = '50 percent discount';
    case two_euro = '2 euro discount';
    case ten_euro = '10 euro discount';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ten_percent => '10 percent discount',
            self::fifty_percent => '50 percent discount',
            self::two_euro => '2 euro discount',
            self::ten_euro => '10 euro discount',
        };
    }
}
