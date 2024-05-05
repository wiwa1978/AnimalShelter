<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RoleNames: string implements HasLabel
{
    case SUPERADMIN = 'super_admin';
    case USER = 'user';

    public function getLabel(): string
    {
        return self::options()[$this->value];
    }

    public static function options(): array
    {
        return [
            self::SUPERADMIN->value => 'super_admin',
            self::USER->value => 'user',
        ];
    }
}
