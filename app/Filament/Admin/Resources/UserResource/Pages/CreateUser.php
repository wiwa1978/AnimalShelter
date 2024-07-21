<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $currentUser = Auth::user()->id;
        Log::debug("(Admin) - User $currentUser | Organisation {$this->getRecord()->organization_id}: User with id {$this->getRecord()->id} and name {$this->getRecord()->name} created");
    }
}
