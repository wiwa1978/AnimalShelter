<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RoleNames: string implements HasLabel
{
    case superadmin = 'Super Admin';
    case user = 'User';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::superadmin => 'Super Admin',
            self::user => 'User',
        };
    }
}
