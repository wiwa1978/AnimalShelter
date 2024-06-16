<?php

namespace App\Http\Responses;
 
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Filament\Notifications\Notification;
use App\Filament\Resources\OrderResource;
use App\Filament\App\Resources\AnimalResource;
use Livewire\Features\SupportRedirects\Redirector;
 
class CustomLoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Here, you can define which resource and which page you want to redirect to
        if (Filament::getCurrentPanel()->getId() === 'app') {

            if ($this->checkProfile()) {
                return redirect()->to('/app');
            }
            else {
                Notification::make()
                    ->title('Please fill in your profile information')
                    //->body('Conversation with subject <a href="' . route('filament.app.tenant.profile', ['tenant' => auth()->user()->organizations->first()->id ])  . '" saved successfully')
                    ->body('Click <a href="' . route('filament.app.tenant.profile', ['tenant' => auth()->user()->organizations->first()->id ]) . '">here</a> to update your profile.')
                    ->send();
            }
                  
        }
        return parent::toResponse($request);
    }

    public function checkProfile()
    {
        $user = auth()->user(); // Get the authenticated user
        $organizationAddress = $user->organizations->first()->billing_address ?? null;

        if (empty($organizationAddress)) {
            // Address is not filled in
            return false;
        } else {
            // Address is filled in
            return true;
        }

    }


}