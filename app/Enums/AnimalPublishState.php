<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalPublishState: string implements HasLabel
{
    case Draft = 'Draft';
    case Published = 'Gepubliceerd';

    case Unpublished = 'Niet gepubliceerd';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Gepubliceerd',
            self::Unpublished => 'Niet gepubliceerd',
        };
    }
}
