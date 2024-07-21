<?php

namespace App\Filament\App\Resources\FavoriteResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\App\Resources\FavoriteResource;

class CreateFavorite extends CreateRecord
{
    protected static string $resource = FavoriteResource::class;

    
    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $currentUser = Auth::user()->id;
        Log::debug("User $currentUser | Organisation {$this->getRecord()->organization_id}: Favorite with id {$this->getRecord()->id} for animal {$this->getRecord()->animal_id} created");
    }
}
