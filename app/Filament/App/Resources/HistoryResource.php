<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Animal;
use App\Models\History;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\HistoryResource\Pages;
use App\Filament\App\Resources\HistoryResource\RelationManagers;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $tenantOwnershipRelationshipName = 'organization';

    protected static ?string $tenantRelationshipName = 'organizations';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function getNavigationGroup(): ?string
    {
        return 'Support';
    }


    public static function getModelLabel(): string
    {
        return __('animals_back.logbook');
    }


    public static function getPluralModelLabel(): string
    {
        return __('animals_back.logbook');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextColumn::make('model_id')
                        ->label('Model ID')
                        ->sortable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user_id')
                    ->formatStateUsing(fn (string $state): string => User::find($state)->name)
                    ->label('Uitgevoerd door')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Omschrijving van de actie')
                    ->sortable()
                    ->searchable(),


                TextColumn::make('created_at')
                    ->label('Uitgevoerd op')
                    ->dateTime('d-m-Y H:i:s'),


            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([

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
            'index' => Pages\ListHistories::route('/'),
            'create' => Pages\CreateHistory::route('/create'),
            'edit' => Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}
