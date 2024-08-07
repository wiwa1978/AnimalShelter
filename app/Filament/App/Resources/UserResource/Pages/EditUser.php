<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->visible(false),

        ];
    }

    protected function afterSave(): void
    {
        // Runs after the form fields are saved to the database.
        $currentUser = Auth::user()->id;
        Log::debug("User $currentUser | Organisation {$this->getRecord()->organization_id}: User with id {$this->getRecord()->id} and (new) name {$this->getRecord()->name} updated");
    }
}
