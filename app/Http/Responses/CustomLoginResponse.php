<?php

namespace App\Http\Responses;
 
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use App\Filament\Resources\OrderResource;
use Livewire\Features\SupportRedirects\Redirector;
 
class CustomLoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Here, you can define which resource and which page you want to redirect to
        if (Filament::getCurrentPanel()->getId() === 'app-ind') {
            return redirect()->to('/');
        }
        return parent::toResponse($request);
    }
}