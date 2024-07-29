<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Animal;
use App\Models\Favorite;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\FavoriteResource\Pages;
use App\Filament\App\Resources\FavoriteResource\RelationManagers;

class FavoriteResource extends Resource
{
    protected static ?string $model = Favorite::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $tenantOwnershipRelationshipName = 'user';

    protected static bool $isScopedToTenant = false;

    public static function canCreate(): bool
    {
        return false;

    }


    public static function getModelLabel(): string
    {
        return __('animals_back.favorites');
    }


    public static function getPluralModelLabel(): string
    {
        return __('animals_back.my_favorites');
    }

    public static function getNavigationBadge(): ?string
    {
        $favoriteCount = Auth::user()->favorites()->count();
        //dd($favoriteCount);
        return $favoriteCount;

    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('animal_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('animal.photo_featured')
                        ->label(__('animals_back.photo'))
                        ->circular(),

                Tables\Columns\TextColumn::make('animal.name')
                    ->label(__('animals_back.animal'))
                    ->sortable(),


                Tables\Columns\TextColumn::make('animal.organization.name')
                    ->label(__('animals_back.stays_at'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('animal.organization.organization_name')
                    ->label(__('animals_back.organization'))
                    ->placeholder('Not applicable')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFavorites::route('/'),
            //'create' => Pages\CreateFavorite::route('/create'),
            //'edit' => Pages\EditFavorite::route('/{record}/edit'),
        ];
    }
}
