<?php

namespace App\Filament\App\Resources\FavoriteResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\FavoriteResource;

class EditFavorite extends EditRecord
{
    protected static string $resource = FavoriteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Runs after the form fields are saved to the database.
        $currentUser = Auth::user()->id;
        Log::debug("User $currentUser | Organisation {$this->getRecord()->organization_id}: Favorite with id {$this->getRecord()->id} for animal with id {$this->getRecord()->animal_id} updated");
    }
}
