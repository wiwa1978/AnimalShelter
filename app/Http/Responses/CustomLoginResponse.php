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
        return parent::toResponse($request);
    }

}