<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use Notification;
use Carbon\Carbon;
use Filament\Actions;
use App\Models\History;
use App\Models\UserInvitation;
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
                ->label(__('users_back.invite_user'))
                ->form([
                    TextInput::make('email')
                        ->email()
                        ->required()
            ])
            ->visible(fn () => Auth::user()->organization_type == 'Organization' || Auth::user()->organization_type == 'Shelter')    
            ->action(function ($data) {
                $invitation = UserInvitation::create(
                    [
                        'email' => $data['email'],
                        'organization_type' => Auth::user()->organizations->first()->organization_type,
                        'organization_id' => Auth::user()->organizations->first()->id,
                        'invited_by' => Auth::user()->id
                    ]
                );

                $history = new History();
                $history->model_id = Auth::user()->id;
                $history->model_type = 'App\Models\User';
                $history->user_id = Auth::user()->id;
                $history->organization_id = Auth::user()->organization()->id;
                $history->description = 'Nieuw teamlid uitgenodigd: '.$data['email']; 
                $history->save(); 

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
