<?php

namespace App\Filament\App\Resources\AnimalResource\Pages;

use App\Filament\App\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
