<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalStatus: string implements HasLabel
{
    case adopted = 'Geadopteerd';
    case adoptable = 'Kan geadopteerd worden';

    case reserved = 'Gereserveerd';
    case pending_treatment = 'Wacht op behandeling';
    case notadoptable = 'Kan niet worden geadopteerd';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::adopted => 'Geadopteerd',
            self::adoptable => 'Kan geadopteerd worden',
            self::reserved => 'Gereserveerd',
            self::pending_treatment => 'Wacht op behandeling',
            self::notadoptable => 'Kan niet worden geadopteerd',
        };
    }
}
