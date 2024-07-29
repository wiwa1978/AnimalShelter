<?php

namespace App\Filament\App\Resources\HistoryResource\Pages;

use App\Filament\App\Resources\HistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistory extends EditRecord
{
    protected static string $resource = HistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
