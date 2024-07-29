<?php

namespace App\Filament\Admin\Resources\UserInvitationResource\Pages;

use App\Filament\Admin\Resources\UserInvitationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserInvitation extends CreateRecord
{
    protected static string $resource = UserInvitationResource::class;
}
