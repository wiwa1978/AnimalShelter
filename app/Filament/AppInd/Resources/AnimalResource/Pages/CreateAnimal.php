<?php

namespace App\Filament\AppInd\Resources\AnimalResource\Pages;

use App\Filament\AppInd\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnimal extends CreateRecord
{
    protected static string $resource = AnimalResource::class;
}
