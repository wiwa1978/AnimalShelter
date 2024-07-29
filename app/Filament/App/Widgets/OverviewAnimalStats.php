<?php

namespace App\Filament\App\Widgets;

use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OverviewAnimalStats extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        $dogCount = Filament::getTenant()->animals()->dogs()->count();
        $catCount = Filament::getTenant()->animals()->cats()->count();
        $otherCount = Filament::getTenant()->animals()->others()->count();

        return [
            Card::make('Aantal honden', $dogCount),
            Card::make('Aantal katten', $catCount),
            Card::make('Aantal andere dieren', $otherCount),
        ];
    }
}

