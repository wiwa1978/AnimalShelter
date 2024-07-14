<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use Tapp\FilamentInvite\Actions\InviteAction;
use App\Filament\App\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\UserResource\Pages\EditUser;
use App\Filament\App\Resources\UserResource\Pages\ListUsers;
use App\Filament\App\Resources\UserResource\Pages\CreateUser;
use App\Filament\App\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $tenantOwnershipRelationshipName = 'organizations';



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
        $userCount = Filament::getTenant()->users()->count();
        return $userCount;
    }

    public static function canCreate(): bool
    {
        $organization = Organization::find(2);
        $plan = $organization->getPlan();
        
        // if the user count is higher than the plan limit, then disable the button
        // if the organization is not free forever (hence is billable), then disable the create button
        if ($organization->users->count() >= $plan->options['users'] && !$organization->isFreeForever()) {
            // Notification::make()
            // ->title('Cannot perform action')
            // ->success()
            // ->send();
            return false;
        }
        
      
        else {
            return true;
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('users_back.name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label(__('users_back.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label(__('users_back.password'))
                    ->password()
                    ->required()
                    ->maxLength(255),
                
                // Select::make('roles')
                //     ->label(__('users_back.roles'))
                //     ->preload()
                //     ->multiple()
                //     ->native(false)
                //     ->relationship('roles', 'name')
                //     ->columnSpan('full'),
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
                
                // TextColumn::make('roles.name')
                //     ->badge(),
                
                // TextColumn::make('organizations.name')
                //     //->formatStateUsing(fn (string $state): string => __("{$state}"))
                //     ->label(__('users_back.organization_name'))
                //     ->placeholder('Not applicable')
                //     ->searchable()
                //     ->sortable(),

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

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                \Tapp\FilamentInvite\Tables\InviteAction::make(),
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

    protected function getHeaderActions(): array
    {
        return [
            InviteAction::make(),
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
