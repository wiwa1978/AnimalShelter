<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User Management';

    public static function getNavigationGroup(): ?string
    {
        return __('users.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return  __('users.users');
    }

    public static function getModelLabel(): string
    {
        return __('users.user');
    }


    public static function getPluralModelLabel(): string
    {
        return __('users.users');
    }

    public static function getNavigationBadge(): ?string
    {
        return User::count();
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->hidden(),
                Select::make('roles')
                    ->preload()
                    ->multiple()
                    ->native(false)
                    ->relationship('roles', 'name')
                    ->columnSpan('full'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('user.roles')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('organization')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Draft' => 'danger',
                        'Published' => 'success'
                    }),
                IconColumn::make('organization')
                    ->alignCenter()
                    ->icon(fn (string $state): string => match ($state) {
                        '0' => 'heroicon-o-user',
                        '1' => 'heroicon-o-user-group',
                    }),
                TextColumn::make('organization_name')
                    //->formatStateUsing(fn (string $state): string => __("{$state}"))
                    ->placeholder('Not applicable')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('organization')
                    ->query(fn (Builder $query): Builder => $query->where('organization', true)),
                Tables\Filters\Filter::make('individual')
                    ->query(fn (Builder $query): Builder => $query->where('organization', false)),

            ])
            ->actions([
                EditAction::make()->color('info'),
                // Action::make('activities')
                //     ->url(fn ($record) => UserResource::getUrl('activities', ['record' => $record]))
                //     ->icon('heroicon-m-envelope')
                //     ->color('success'),
                DeleteAction::make()
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
            RelationManagers\AnimalsRelationManager::class,
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
