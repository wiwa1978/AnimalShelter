<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Animal;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\AnimalResource\Pages;
use App\Filament\App\Resources\AnimalResource\RelationManagers;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('animals.animal');
    }

    public static function getPluralModelLabel(): string
    {
        return __('animals.my_animals');
    }

    public static function getNavigationBadge(): ?string
    {
        return Animal::count();
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
        return $table
            ->columns([
                ImageColumn::make('photo_featured')
                ->label('Photo')
                ->circular(),

            TextColumn::make('name')
                ->sortable()
                ->searchable(isIndividual: false, isGlobal: true),

            IconColumn::make('featured')
                ->sortable()
                ->boolean(),

            TextColumn::make('published_state')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Draft' => 'warning',
                    'Gepubliceerd' => 'success',
                    'Niet gepubliceerd' => 'danger'
                })
                ->sortable()
                ->searchable(),

            TextColumn::make('approval_state')
                ->badge()
                // ->color(fn (string $state): string => match ($state) {
                //     'NotApproved' => 'danger',
                //     'InReview' => 'warning',
                //     'Approved' => 'success'
                // })
                ->sortable()
                ->searchable(),


            TextColumn::make('published_at')
                ->dateTime('d-m-Y H:i')
                ->placeholder((' --- '))
                //->since()
                ->sortable()
                ->searchable(),
            // TextColumn::make('publish_price')

            //     ->money('EUR', divideBy: 100),
            //->summarize(Summarizers\Sum::make()),
            // TextColumn::make('user.name')
            //     ->url(fn (Animal $animal): string => UserResource::getUrl('edit', ['record' => $animal->user_id]))
            //     ->sortable()
            //     ->numeric()
            //     ->sortable(),
            TextColumn::make('animal_type')

                ->sortable()
                ->searchable(),
            TextColumn::make('location')
                ->sortable()
                ->searchable(),
            TextColumn::make('age')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable()
                ->searchable(),
            TextColumn::make('gender')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('status')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('size')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            TextColumn::make('breed')
                ->toggleable(isToggledHiddenByDefault: true)
                ->searchable(),
            IconColumn::make('sterilized')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('chipped')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('passport')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('vaccinated')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('rabies')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('medicins')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('special_food')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('behavioural_problem')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('kids_friendly')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('cats_friendly')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('dogs_friendly')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('well_behaved')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('playful')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('everybody_friendly')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            IconColumn::make('affectionate')
                ->toggleable(isToggledHiddenByDefault: true)
                ->boolean(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
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
