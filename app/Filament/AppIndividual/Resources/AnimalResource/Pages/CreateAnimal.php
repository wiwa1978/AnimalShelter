<?php

namespace App\Filament\AppIndividual\Resources\AnimalResource\Pages;

use App\Filament\AppIndividual\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;
}
