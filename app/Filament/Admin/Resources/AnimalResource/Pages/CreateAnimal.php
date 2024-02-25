<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use App\Filament\Admin\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['publish_price'] = $data['publish_price'] * 100;

        return $data;
    }
}
