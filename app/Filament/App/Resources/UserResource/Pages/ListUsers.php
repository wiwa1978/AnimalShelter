<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use Notification;
use Carbon\Carbon;
use Filament\Actions;
use App\Models\Invitation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrganizationInvitationMail;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use App\Filament\App\Resources\UserResource;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
     
        return [

            
            //Actions\CreateAction::make(),

            Actions\Action::make('inviteUser')
            ->form([
                TextInput::make('email')
                    ->email()
                    ->required()
            ])
            ->action(function ($data) {
                $invitation = Invitation::create(
                    [
                        'email' => $data['email'],
                        'organization_type' => Auth::user()->organizations->first()->organization_type,
                        'organization_id' => Auth::user()->organizations->first()->id,
                    ]
                );

                Mail::to($invitation->email)->send(new OrganizationInvitationMail($invitation));
                Log::debug("Invitation created and mail send to: {$data['email']}");

                // Notification::make('invitedSuccess')
                //     ->body('User invited successfull')
                //     ->success()
                //     ->send();
                
            })
           
        ];
    }

}
