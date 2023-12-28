<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use App\Filament\Admin\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['published_price'] = $data['published_price'] * 100;

        return $data;
    }
}
