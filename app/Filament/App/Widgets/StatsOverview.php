<?php

namespace App\Filament\App\Widgets;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = Filament::getTenant()->users()->count();
        $animalCount = Filament::getTenant()->animals()->count();
        $favoriteCount =  Auth::user()->favorites()->count();
        
        return [
            Card::make('Aantal gebruikers', $userCount),
            Card::make('Aantal dieren', $animalCount),
            Card::make('Aantal favorieten', $favoriteCount),
        ];
    }
}
