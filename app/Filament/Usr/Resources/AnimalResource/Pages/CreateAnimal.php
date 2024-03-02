<?php

namespace App\Filament\Usr\Resources\AnimalResource\Pages;

use App\Filament\Usr\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;
}
