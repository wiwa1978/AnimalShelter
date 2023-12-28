<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use App\Filament\Admin\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['published_price'] = $data['published_price'] / 100;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['published_price'] = $data['published_price'] * 100;

        return $data;
    }
}
