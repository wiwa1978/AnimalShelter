<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Models\User;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\UserResource;

class ListUsers extends ListRecords
{


    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        $superAdmins = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'super_admin')->toArray()
        );

        $regularUsers = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', '<>', 'super_admin')->toArray()
        );



        $tabs['all'] = Tab::make('All Users')
            ->badge(User::count());

        $tabs['admin'] = Tab::make('Admins')
            ->badge($superAdmins->count())
            ->modifyQueryUsing(function ($query) {
                return $query->superAdmins();
            });

        $tabs['users'] = Tab::make('Regular Users')
            ->badge($regularUsers->count())
            ->modifyQueryUsing(function ($query) {
                return $query->regularUsers();
            });

        $tabs['Individual'] = Tab::make('Individuals')
            ->badge((string)User::query()->where('organization', false)->count())
            ->modifyQueryUsing(fn (Builder $query) => $query->where('organization', false));

        $tabs['Organization'] = Tab::make('Organization')
            ->badge((string)User::query()->where('organization', true)->count())
            ->modifyQueryUsing(fn (Builder $query) => $query->where('organization', true));


        return $tabs;
    }
}
