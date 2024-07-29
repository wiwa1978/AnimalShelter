<?php

namespace App\Filament\Admin\Resources\UserInvitationResource\Pages;

use App\Filament\Admin\Resources\UserInvitationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserInvitation extends EditRecord
{
    protected static string $resource = UserInvitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
