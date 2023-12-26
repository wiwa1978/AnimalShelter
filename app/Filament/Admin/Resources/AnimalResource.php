<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Animal;
use Filament\Forms\Form;
use App\Enums\AnimalSize;
use App\Enums\AnimalType;
use Filament\Tables\Table;
use App\Enums\AnimalGender;
use App\Enums\AnimalStatus;
use App\Enums\AnimalLocation;
use App\Enums\AnimalPublishState;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Admin\Resources\AnimalResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AnimalResource\RelationManagers;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone number')
                            ->tel()
                            ->required(),
                    ])
                    ->required(),
                Toggle::make('featured')
                    ->required(),
                TextInput::make('slug')
                    ->maxLength(255),

                Select::make('published_state')
                    ->options(AnimalPublishState::class)
                    ->native(false)
                    ->preload()
                    ->required(),
                DateTimePicker::make('published_at')
                    ->native(false),
                TextInput::make('published_price')
                    ->required()
                    ->numeric()
                    ->default(10000),
                Select::make('animal_type')
                    ->options(AnimalType::class)
                    ->native(false)
                    ->preload()
                    ->required(),
                Select::make('location')
                    ->required()
                    ->native(false)
                    ->preload()
                    ->label('Current location of the animal')
                    ->options(AnimalLocation::class),
                Radio::make('age')
                    ->options([
                        '0-1 years' => '0-1 years',
                        '1-2 years' => '1-2 years',
                        '2-3 years' => '2-3 years',
                        '3-4 years' => '3-4 years',
                        '4-5 years' => '4-5 years',
                        '5-6 years' => '5-6 years',
                        '6-7 years' => '6-7 years',
                        '7-8 years' => '7-8 years',
                        '8-9 years' => '8-9 years',
                        '9-10 years' => '9-10 years',
                        'older than 10 years' => 'older than 10 years',
                        'older than 15 years' => 'older than 15 years',
                    ])
                    ->columns(3)
                    ->gridDirection('row')
                    ->required(),
                Select::make('gender')
                    ->required()
                    ->preload()
                    ->native(false)
                    ->options(AnimalGender::class),
                Select::make('status')
                    ->required()
                    ->label('Adoption Status')
                    ->native(false)
                    ->preload()
                    ->options(AnimalStatus::class),
                Select::make('size')
                    ->required()
                    ->native(false)
                    ->label('Animal Size')
                    ->options(AnimalSize::class),
                MarkdownEditor::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TextInput::make('breed')
                    ->required()
                    ->maxLength(255),
                TextInput::make('reason_adoption')
                    ->required()
                    ->maxLength(255),
                Toggle::make('sterilized')
                    ->required(),
                Toggle::make('chipped')
                    ->required(),
                Toggle::make('passport')
                    ->required(),
                Toggle::make('vaccinated')
                    ->required(),
                Toggle::make('rabies')
                    ->required(),
                Toggle::make('medicins')
                    ->required(),
                Toggle::make('special_food')
                    ->required(),
                Toggle::make('behavioural_problem')
                    ->required(),
                Toggle::make('kids_friendly')
                    ->required(),
                Toggle::make('cats_friendly')
                    ->required(),
                Toggle::make('dogs_friendly')
                    ->required(),
                MarkdownEditor::make('environment')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Toggle::make('well_behaved')
                    ->required(),
                Toggle::make('playful')
                    ->required(),
                Toggle::make('everybody_friendly')
                    ->required(),
                Toggle::make('affectionate')
                    ->required(),
                FileUpload::make('photo_featured')
                    ->acceptedFileTypes($types = ['jpg', 'jpeg', 'png'])
                    ->image()
                    ->maxSize(15000) // Set the maximum size of files that can be uploaded, in kilobytes.
                    ->label('Main Photo (max 1 photo | only jpg, jpeg, png extensions)')
                    ->directory(fn ($get) => str_replace(' ', '', 'media/' . $get('name')))
                    ->imageEditor()
                    ->columnSpan('full'),
                FileUpload::make('photos_additional')
                    ->label('Additional Photos (max 20 photos | only jpg, jpeg, png extensions)')
                    ->multiple()
                    ->directory(fn ($get) => str_replace(' ', '', 'media/' . $get('name')))
                    ->reorderable()
                    ->appendFiles()
                    ->maxFiles(20)
                    ->columnSpan('full'),
                FileUpload::make('videos')
                    ->multiple()
                    ->maxSize(50000)
                    ->maxFiles(4)
                    ->acceptedFileTypes($types = ['video/mp4'])
                    ->label('Media (max 4 videos | max 50MB |  mp4 only)')
                    ->directory(fn ($get) => str_replace(' ', '', 'media/' . $get('name')))
                    ->previewable(true)
                    ->columnSpan('full'),
                KeyValue::make('youtube_links')
                    ->label('Youtube URL (example: Key: video1 & Value: https://www.youtube.com/watch?v=1234567890)')
                    ->columnSpanFull()

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
                Tables\Actions\Action::make('Publish')
                    ->icon('heroicon-m-pencil-square')
                    ->form([
                        Forms\Components\Select::make('published_state')
                            ->label('Current Publish State')
                            ->options(AnimalPublishState::class)
                            ->default(function (Animal $record) {
                                return $record->published_state;
                            })
                            ->preload()
                            ->native(false),
                    ])
                    ->action(function (Animal $animal, array $data): void {
                        $animal->published_state = $data['published_state'];
                        $animal->save();
                    }),





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
