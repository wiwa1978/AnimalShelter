<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RoleNames: string implements HasLabel
{
    case super_admin = 'super_admin';
    case user = 'user';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::super_admin => 'super_admin',
            self::user => 'user',
        };
    }
}
