<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';

    public static function getNavigationGroup(): ?string
    {
        return __('users_back.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return  __('users_back.users');
    }

    public static function getModelLabel(): string
    {
        return __('users_back.user');
    }


    public static function getPluralModelLabel(): string
    {
        return __('users_back.users');
    }

    public static function getNavigationBadge(): ?string
    {
       // return User::count();
        $userCount = User::count();
        return $userCount;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $organization = Organization::find(1);
        $plan = $organization->getPlan();
        
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('users_back.name'))
                    ->searchable(),
                
                TextColumn::make('email')
                    ->label(__('users_back.email'))
                    ->searchable(),
                
                TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn (String $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'user' => 'success',
                    }),

                TextColumn::make('organizations.billing_city')
                    ->label(__('users_back.billing_city'))
                    ->searchable(),

                TextColumn::make('organizations.organization_name')
                    ->label(__('users_back.organization_name'))
                    ->searchable()
                    ->visible(fn (): bool => Auth::user()->organizations->first()->organization_type == 'Asiel' || Auth::user()->organizations->first()->organization_type == 'Stichting')
                    ->getStateUsing( function (User $record){
                        return $record->organizations->first()->organization_name ?? 'NA';
                    }),


                TextColumn::make('subscription')
                    ->label(__('users_back.current_plan'))
                    ->getStateUsing( function (User $record){
                        //return optional($record->organizations->first()->getPlan())->name ?? 'NA';
                        return $record->organizations->first()->getPlan()->name == 'fallback' ? 'Geen' : $record->organizations->first()->getPlan()->name;
                    }),
                
 
                                
                TextColumn::make('created_at')
                    ->label(__('users_back.created_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('users_back.updated_at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
