<?php

namespace App\Filament\App\Resources\AnimalResource\Pages;

use Filament\Actions;
use App\Models\Animal;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\AnimalResource;
use App\Filament\App\Resources\AnimalResource\Widgets\AnimalOverview;
use App\Filament\App\Resources\AnimalResource\Widgets\AnimalOverviewChart;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AnimalOverview::class,
            //AnimalOverviewChart::class,
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        foreach ($data['youtube_links'] as $key => $value) {
            $data['youtube_links'][$key] = str_replace('watch?v=', 'embed/', $value);
        }

        foreach ($data['youtube_links'] as $key => $value) {
            $data['youtube_links'][$key] = str_replace('youtu.be', 'www.youtube.com/embed', $value);
        }

        foreach ($data['youtube_links'] as $key => $value) {
            $data['youtube_links'][$key] = str_replace('shorts', 'embed', $value);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        // Runs after the form fields are saved to the database.
        $currentUser = Auth::user()->id;
        Log::debug("User $currentUser | Organisation {$this->getRecord()->organization_id}: Animal with id {$this->getRecord()->id} and (new) name {$this->getRecord()->name} updated");
    }

}
