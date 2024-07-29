<?php

namespace App\Filament\App\Resources\AnimalResource\Pages;

use Actions\Redirect;
use Filament\Actions;
use App\Models\Animal;
use App\Enums\AnimalSize;
use App\Enums\AnimalType;
use Illuminate\Support\Str;
use App\Enums\AnimalPublishState;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\App\Resources\AnimalResource;
use App\Filament\App\Resources\AnimalResource\Widgets\AnimalOverview;


class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    
    public $defaultAction = 'profileInfo';

    public function profileInfo(): Actions\Action
    {
        $user = auth()->user(); 
        $organization = $user->organization(); 
        $profileInfoCompleted = $organization->billing_address 
        && $organization->billing_city 
        && $organization->billing_state
        && $organization->billing_postal_code;

        return Actions\Action::make('profileInfo')
            ->visible(empty($profileInfoCompleted))
            ->modalSubmitActionLabel('Ga naar profiel')
            ->action(fn () => redirect()->route('filament.app.tenant.profile', ['tenant' => auth()->user()->organization()->id ]))
            ->color('primary')
            ->modalCancelAction(false)
            ->modalHeading('Profiel informatie ontbreekt')
            ->modalDescription('Het lijkt erop dat jouw profiel informatie nog niet compleet is. Vul de ontbrekende informatie in om verder te gaan')
            ->closeModalByClickingAway(false);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // protected function getHeaderWidgets(): array {
    //     return [
    //         AnimalOverview::class,
    //     ];
    // }


    public function getTabs(): array
    {
        $animal_types = AnimalType::cases();
        $animal_publish_state = AnimalPublishState::cases();

        $currentUser = Auth::user();
        $currentOrganization = $currentUser->organization()->id;



        $tabs['all'] = Tab::make()
                ->badge((string)Animal::where('organization_id', $currentOrganization)->count());

        foreach ($animal_types as $type) {
            $tabs[Str::headline($type->value)] = Tab::make()
                ->badge((string)Animal::query()
                        ->where('organization_id', $currentOrganization)
                        ->where('animal_type', $type)
                        ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('organization_id', $currentOrganization)
                    ->where('animal_type', $type));
        }


 
        $tabs['featured'] = Tab::make()
            ->badge((string)Animal::query()->where('organization_id', $currentOrganization)->where('featured', true)->count())
            ->modifyQueryUsing(fn (Builder $query) => $query->where('featured', True));


        foreach ($animal_publish_state as $state) {
            $tabs[Str::headline($state->value)] = Tab::make()
                ->badge((string)Animal::query()
                        ->where('organization_id', $currentOrganization)
                        ->where('published_state', $state)
                        ->count())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('organization_id', $currentOrganization)
                    ->where('published_state', $state));
        }



        return $tabs;
    }
}
