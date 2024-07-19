<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\AnimalResource;
use Howdu\FilamentRecordSwitcher\Filament\Concerns\HasRecordSwitcher;

class EditAnimal extends EditRecord
{
    use HasRecordSwitcher;
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
           
            //\Mansoor\FilamentVersionable\Page\RevisionsAction::make(),
        ];

       
    }

    protected function afterEdit(array $data): void
    {
        // Runs after the form fields are saved to the database.
        Log::debug("Animal updated: {$data['id']}");
    }


}
