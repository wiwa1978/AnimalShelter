<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
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
            fn ($user) => $user->roles->where('name', 'Super Admin')->toArray()
        );

        $regularUsers = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', '<>', 'Super Admin')->toArray()
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

        return $tabs;
    }
}
