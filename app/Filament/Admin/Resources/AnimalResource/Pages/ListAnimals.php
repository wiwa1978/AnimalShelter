<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use Filament\Actions;
use App\Models\Animal;
use App\Enums\AnimalSize;
use App\Enums\AnimalType;
use Illuminate\Support\Str;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\AnimalResource;

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
        $animal_sizes = AnimalSize::cases();
        $animal_types = AnimalType::cases();


        $tabs = [
            'all' => Tab::make()
                ->badge((string)Animal::count())
        ];
        foreach ($animal_sizes as $size) {
            $tabs[Str::headline($size->value)] = Tab::make()
                ->badge((string)Animal::query()->where('size', $size)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('size', $size));
        }

        foreach ($animal_types as $type) {
            $tabs[Str::headline($type->value)] = Tab::make()
                ->badge((string)Animal::query()->where('animal_type', $type)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('animal_type', $type));
        }

        return $tabs;
    }
}