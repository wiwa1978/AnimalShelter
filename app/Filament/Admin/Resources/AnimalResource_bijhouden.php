<?php

namespace App\Filament\Admin\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Animal;
use Filament\Forms\Form;
use App\Enums\AnimalSize;
use App\Enums\AnimalType;
use Filament\Tables\Table;
use App\Enums\AnimalGender;
use App\Enums\AnimalStatus;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use App\Enums\AnimalLocation;
use Filament\Resources\Resource;
use App\Enums\AnimalPublishState;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\AnimalResource\Pages;
use App\Filament\Admin\Resources\AnimalResource\RelationManagers;

class AnimalResource1 extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $tenantOwnershipRelationshipName = 'organizations';

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

    public static function form(Form $form,  ): Form
    {
        return $form
        ->schema([
            Grid::make(4)
                ->schema([
                    Section::make(__('animals.general_info'))
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                        ->schema([
                            TextInput::make('name')
                                ->label(__('animals.name'))
                                ->minLength(2)
                                ->maxLength(100)
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                ->validationAttribute('full name')
                                ,

                            TextInput::make('slug')
                                ->disabled()
                                ->required(),
                            
                            RichEditor::make('description')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),

                            Select::make('animal_type')
                                ->options(AnimalType::class)
                                ->native(false)
                                ->preload()
                                ->required(),
                               

                            Select::make('current_location')
                                ->required()
                                ->native(false)
                                ->preload()
                                ->label('Current location of the animal')
                                ->options(AnimalLocation::class),
                               

                            Select::make('original_location')
                                ->required()
                                ->native(false)
                                ->preload()
                                ->label('Original location of the animal')
                                ->options(AnimalLocation::class),
                                
                                
                            
                            Select::make('gender')
                                ->required()
                                ->preload()
                                ->native(false)
                                ->options(AnimalGender::class),

                            
                            Select::make('size')
                                ->required()
                                ->native(false)
                                ->label('Animal Size')
                                ->options(AnimalSize::class),
                            TextInput::make('breed')
                                ->required()
                                ->maxLength(255),
                            Select::make('status')
                                ->required()
                                ->label('Adoption Status')
                                ->native(false)
                                ->preload()
                                ->options(AnimalStatus::class),

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
                                ->columnSpanFull()
                                ->gridDirection('row')
                                ->required(),
                        ])
                        ->columnSpan(3),


                    Section::make(__('animals.publish_info'))->visible(fn ($context): int => $context === 'edit')
                        ->schema([
                            Toggle::make('featured')
                               
                                ->required(),

                            Toggle::make('published')
                                ->required(),

                            // Select::make('published_state')
                            //     ->label('Published')
                            //     ->options(AnimalPublishState::class)
                            //     ->native(false)
                            //     ->preload()
                            //     ->required(),
                            // DateTimePicker::make('published_at')

                            //     ->displayFormat('d/m/Y')
                            //     ->native(false),
                            // TextInput::make('publish_price')
                            //     ->required()
                            //     ->prefix('EUR')
                            //     ->mask(RawJs::make('$money($input)'))
                            //     ->numeric()

                        ])


                        ->columnSpan(1),


                    Section::make(__('animals.medical_social_info'))
                        ->schema([
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
                            Toggle::make('kids_friendly_6y')
                                ->required(),
                            Toggle::make('kids_friendly_14y')
                                ->required(),
                            Toggle::make('cats_friendly')
                                ->required(),
                            Toggle::make('dogs_friendly')
                                ->required(),

                            Toggle::make('well_behaved')
                                ->required(),
                            Toggle::make('playful')
                                ->required(),
                            Toggle::make('everybody_friendly')
                                ->required(),
                            Toggle::make('affectionate')
                                ->required(),
                            Toggle::make('needs_garden')
                                ->required(),
                            Toggle::make('potty_trained')
                                ->required(),
                            Toggle::make('car_friendly')
                                ->required(),
                            Toggle::make('home_alone')
                                ->required(),
                            Toggle::make('knows_commands')
                                ->required(),
                                Toggle::make('experience_required')
                                ->required(),


                            MarkdownEditor::make('environment')
                                ->label('Describe the environment the animal would ideally have (e.g garden, no children, etc...')
                                ->required()
                                ->maxLength(65535)
                                ->columnSpanFull(),

                        ])
                        ->columns(4)
                        ->columnSpan(3),
                    Section::make(__('animals.media'))
                        ->schema([
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
                        ])
                        ->columnSpan(3),

                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            
            ImageColumn::make('photo_featured')
                ->label('Photo')
                ->circular(),
            
            TextColumn::make('animal_type')
                ->sortable()
                ->searchable(),

            TextColumn::make('name')
                ->sortable()
                ->searchable(isIndividual: false, isGlobal: true),

            IconColumn::make('featured')
                ->alignCenter()
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
                ->color(fn (string $state): string => match ($state) {
                    'Wordt beoordeeld' => 'warning',
                    'Goedgekeurd' => 'success',
                    'Afgekeurd' => 'danger'
                })
                ->sortable()
                ->searchable(),

            


            // TextColumn::make('published_at')
            //     ->dateTime('d-m-Y H:i')
            //     ->placeholder((' --- '))
            //     //->since()
            //     ->sortable()
            //     ->searchable(),
            // TextColumn::make('publish_price')

            //     ->money('EUR', divideBy: 100),
            //->summarize(Summarizers\Sum::make()),
            // TextColumn::make('user.name')
            //     ->url(fn (Animal $animal): string => UserResource::getUrl('edit', ['record' => $animal->user_id]))
            //     ->sortable()
            //     ->numeric()
            //     ->sortable(),
           
            TextColumn::make('current_location')
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
                Tables\Filters\Filter::make('featured')
                    ->query(fn (Builder $query): Builder => $query->where('featured', true)),
                Tables\Filters\Filter::make('sterilized')
                    ->query(fn (Builder $query): Builder => $query->where('sterilized', true)),
                Tables\Filters\Filter::make('chipped')
                    ->query(fn (Builder $query): Builder => $query->where('chipped', true)),
                Tables\Filters\Filter::make('passport')
                    ->query(fn (Builder $query): Builder => $query->where('passport', true)),
                Tables\Filters\Filter::make('vaccinated')
                    ->query(fn (Builder $query): Builder => $query->where('vaccinated', true)),
                Tables\Filters\Filter::make('rabies')
                    ->query(fn (Builder $query): Builder => $query->where('rabies', true)),
                Tables\Filters\Filter::make('medicins')
                    ->query(fn (Builder $query): Builder => $query->where('medicins', true)),
                Tables\Filters\Filter::make('special_food')
                    ->query(fn (Builder $query): Builder => $query->where('special_food', true)),
                Tables\Filters\Filter::make('behavioural_problem')
                    ->query(fn (Builder $query): Builder => $query->where('behavioural_problem', true)),
                Tables\Filters\Filter::make('kids_friendly')
                    ->query(fn (Builder $query): Builder => $query->where('kids_friendly', true)),
                Tables\Filters\Filter::make('cats_friendly')
                    ->query(fn (Builder $query): Builder => $query->where('cats_friendly', true)),
                Tables\Filters\Filter::make('dogs_friendly')
                    ->query(fn (Builder $query): Builder => $query->where('dogs_friendly', true)),
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')->native(false),
                        Forms\Components\DatePicker::make('published_until')->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('delete')
                        ->action(fn (Animal $record) => $record->delete())
                        ->requiresConfirmation(),
                    Tables\Actions\Action::make('Publish')
                        ->requiresConfirmation()
                        ->icon('heroicon-m-pencil-square')
                        ->color('info')
                        ->action(function (Animal $animal, array $data): void {
                            $animal->published_state = AnimalPublishState::Published;
                            $animal->published_at = Carbon::now()->format('Y-m-d H:i:s');
                            $animal->save();

                            Notification::make()
                                ->title('Success')
                                ->success('')
                                ->body('Animal published successfully')
                                ->send();
                        })

                        ->visible(function (Animal $record) {
                            return $record->published_state == 'Draft' ? true : false;
                        }),


                    Tables\Actions\Action::make('Unpublish')
                        ->icon('heroicon-m-pencil-square')
                        ->color('info')
                        ->form([
                            Forms\Components\TextInput::make('unpublish_reason')
                                ->label('Reason')
                                ->required()
                        ])
                        ->action(function (Animal $animal, array $data): void {
                            $animal->published_state = AnimalPublishState::Draft;
                            $animal->unpublished_at = Carbon::now()->format('Y-m-d H:i:s');
                            $animal->unpublish_reason = $data['unpublish_reason'];
                            $animal->save();
                            Notification::make()
                                ->title('Success')
                                ->success('')
                                ->body('Animal unpublished successfully')
                                ->send();
                        })
                        ->visible(function (Animal $record) {
                            return $record->published_state == 'Published' ? true : false;
                        }),
                ])
                ->iconButton()
                ->button()
                ->label('Actions')
                ->icon('heroicon-m-ellipsis-horizontal')
                ->color('success'),
                
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
