<?php

namespace App\Filament\App\Resources\AnimalResource\Pages;



use Carbon\Carbon;


use App\Models\Animal;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Actions\Action;
use App\Filament\App\Resources\AnimalResource;



class CreateAnimal extends CreateRecord
{
    #test
    protected static string $resource = AnimalResource::class;

    protected static bool $canCreateAnother = false;
    

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['data_added'] = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($data['youtube_links'] as $key => $value) {
            $data['youtube_links'][$key] = str_replace('watch?v=', 'embed/', $value);
        }

        foreach ($data['youtube_links'] as $key => $value) {
            $data['youtube_links'][$key] = str_replace('youtu.be', 'www.youtube.com/embed/', $value);
        }

        foreach ($data['youtube_links'] as $key => $value) {
            $data['youtube_links'][$key] = str_replace('shorts', 'embed', $value);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $currentUser = Auth::user()->id;
        Log::debug("User $currentUser | Organisation {$this->getRecord()->organization_id}: Animal with id {$this->getRecord()->id} and name {$this->getRecord()->name} created");
    }

    
   
}
