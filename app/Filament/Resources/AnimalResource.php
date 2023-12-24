<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnimalResource\Pages;
use App\Filament\Resources\AnimalResource\RelationManagers;
use App\Models\Animal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('featured')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255),
                Forms\Components\TextInput::make('published_state')
                    ->required()
                    ->maxLength(255)
                    ->default('draft'),
                Forms\Components\TextInput::make('published_at')
                    ->required()
                    ->maxLength(255)
                    ->default('draft'),
                Forms\Components\TextInput::make('published_price')
                    ->required()
                    ->numeric()
                    ->default(10000),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('animal_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('breed')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('reason_adoption')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('sterilized')
                    ->required(),
                Forms\Components\Toggle::make('chipped')
                    ->required(),
                Forms\Components\Toggle::make('passport')
                    ->required(),
                Forms\Components\Toggle::make('vaccinated')
                    ->required(),
                Forms\Components\Toggle::make('rabies')
                    ->required(),
                Forms\Components\Toggle::make('medicins')
                    ->required(),
                Forms\Components\Toggle::make('special_food')
                    ->required(),
                Forms\Components\Toggle::make('behavioural_problem')
                    ->required(),
                Forms\Components\Toggle::make('kids_friendly')
                    ->required(),
                Forms\Components\Toggle::make('cats_friendly')
                    ->required(),
                Forms\Components\Toggle::make('dogs_friendly')
                    ->required(),
                Forms\Components\Textarea::make('environment')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('well_behaved')
                    ->required(),
                Forms\Components\Toggle::make('playful')
                    ->required(),
                Forms\Components\Toggle::make('everybody_friendly')
                    ->required(),
                Forms\Components\Toggle::make('affectionate')
                    ->required(),
                Forms\Components\TextInput::make('photo_featured')
                    ->maxLength(255),
                Forms\Components\Textarea::make('photos_additional')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('videos')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('youtube_links')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('animal_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('breed')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reason_adoption')
                    ->searchable(),
                Tables\Columns\IconColumn::make('sterilized')
                    ->boolean(),
                Tables\Columns\IconColumn::make('chipped')
                    ->boolean(),
                Tables\Columns\IconColumn::make('passport')
                    ->boolean(),
                Tables\Columns\IconColumn::make('vaccinated')
                    ->boolean(),
                Tables\Columns\IconColumn::make('rabies')
                    ->boolean(),
                Tables\Columns\IconColumn::make('medicins')
                    ->boolean(),
                Tables\Columns\IconColumn::make('special_food')
                    ->boolean(),
                Tables\Columns\IconColumn::make('behavioural_problem')
                    ->boolean(),
                Tables\Columns\IconColumn::make('kids_friendly')
                    ->boolean(),
                Tables\Columns\IconColumn::make('cats_friendly')
                    ->boolean(),
                Tables\Columns\IconColumn::make('dogs_friendly')
                    ->boolean(),
                Tables\Columns\IconColumn::make('well_behaved')
                    ->boolean(),
                Tables\Columns\IconColumn::make('playful')
                    ->boolean(),
                Tables\Columns\IconColumn::make('everybody_friendly')
                    ->boolean(),
                Tables\Columns\IconColumn::make('affectionate')
                    ->boolean(),
                Tables\Columns\TextColumn::make('photo_featured')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
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
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }
}
