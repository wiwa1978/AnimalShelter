<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\AnimalResource;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;

    protected function afterCreate(array $data): void
    {
        // Runs after the form fields are saved to the database.
        Log::debug("Animal created: {$data['id']}");
    }
}
