<?php

namespace App\Filament\Admin\Resources\PurchaseResource\Pages;

use App\Filament\Admin\Resources\PurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchase extends ViewRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
