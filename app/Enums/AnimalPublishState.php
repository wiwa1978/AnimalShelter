<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalPublishState: string implements HasLabel
{
    case draft = 'draft';
    case published = 'published';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::draft => 'Draft',
            self::published => 'Published',
        };
    }
}
