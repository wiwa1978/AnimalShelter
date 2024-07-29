<?php

namespace App\Filament\App\Resources\AnimalResource\Widgets;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AnimalOverview extends BaseWidget
{
    public ?Model $record = null;
    
    protected function getStats(): array
    {
        $clickCount = $this->record->total_clicks;
        $favCount = $this->record->total_favorited;

        return [
            Card::make('Aantal bezoekers', $clickCount),
            Card::make('Aantal keer favoriet', $favCount),

        ];
    }

    protected function getColumns(): int
    {
        return 2;
    } 
}
