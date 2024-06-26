<?php

namespace App\Filament\App\Resources\AnimalResource\Pages;

use App\Filament\App\Resources\AnimalResource\Widgets\StatsOverview;
use Filament\Actions;
use App\Models\Animal;
use App\Enums\AnimalSize;
use App\Enums\AnimalType;
use Illuminate\Support\Str;
use App\Enums\AnimalPublishState;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\App\Resources\AnimalResource;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getTabs(): array
    {
        $animal_types = AnimalType::cases();
        $animal_publish_state = AnimalPublishState::cases();


        $tabs = [
            'all' => Tab::make()
                ->badge((string)Animal::count()),

            'Featured' => Tab::make()
                ->badge((string)Animal::query()->where('featured', true)->count())
        ];

        foreach ($animal_publish_state as $state) {
            $tabs[Str::headline($state->value)] = Tab::make()
                ->badge((string)Animal::query()->where('published_state', $state)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('published_state', $state));
        }



        foreach ($animal_types as $type) {
            $tabs[Str::headline($type->value)] = Tab::make()
                ->badge((string)Animal::query()->where('animal_type', $type)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('animal_type', $type));
        }

        return $tabs;
    }
}
