<?php

namespace App\Filament\App\Pages\Auth;

use Exception;
use Filament\Pages\Page;

use Filament\Facades\Filament;
use App\Enums\OrganizationType;
use Filament\Events\Auth\Registered;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Pages\Auth\Register as BaseRegister;
use App\Notifications\EmailVerificationNotification;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Register extends BaseRegister
{

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRoleFormComponent(), 
                    ])
                    ->statePath('data'),
            ),
        ];
    }
 
    protected function getRoleFormComponent(): Component
    {
           return Select::make('organization_type')
            // ->options([
            //     'Particulier' => 'Particulier',
            //     'Stichting' => 'Stichting',
            //     'Asiel' => 'Asiel',
            // ])
            ->options(OrganizationType::class)
            ->required();
    
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeRegister($data);

            $this->callHook('beforeRegister');

            $user = $this->handleRegistration($data);

            $this->form->model($user)->saveRelationships();

            $this->callHook('afterRegister');

            return $user;
        });

        event(new Registered($user));

        $this->sendEmailVerificationNotification($user);

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    protected function sendEmailVerificationNotification($user): void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        if (! method_exists($user, 'notify')) {
            $userClass = $user::class;

            throw new Exception("Model [{$userClass}] does not have a [notify()] method.");
        }

        $notification = app(EmailVerificationNotification::class);
        $notification->url = Filament::getVerifyEmailUrl($user);

        $user->notify($notification);
    }


   

   
}
