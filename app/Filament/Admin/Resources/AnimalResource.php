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
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use App\Enums\AnimalLocation;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use App\Enums\AnimalPublishState;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\AnimalResource\Pages;
use App\Filament\Admin\Resources\AnimalResource\RelationManagers;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([















                Section::make('General Information')
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->maxLength(255)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (\Closure $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')->required(),
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
                        MarkdownEditor::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
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
                        Select::make('gender')
                            ->required()
                            ->preload()
                            ->native(false)
                            ->options(AnimalGender::class),
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
                            ->options(AnimalStatus::class)
                    ]),

                #### MEDICAL & SOCIAL INFORMATION ####

                Section::make('Medical & Social Information')
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
                        Toggle::make('kids_friendly')
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

                        MarkdownEditor::make('environment')
                            ->label('Describe the environment the animal would ideally have (e.g garden, no children, etc...')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),

                    ])->columns(4),

                #### MEDIA ####

                Section::make('Media')
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
                    ]),

                #### PUBLICATION DETAILS ####

                Section::make('Publication Details')
                    ->schema([
                        Toggle::make('featured')
                            ->required(),

                        Select::make('published_state')
                            ->options(AnimalPublishState::class)
                            ->native(false)
                            ->preload()
                            ->required(),
                        DateTimePicker::make('published_at')

                            ->displayFormat('d/m/Y')
                            ->native(false),
                        TextInput::make('publish_price')
                            ->required()
                            ->prefix('EUR')
                            ->mask(RawJs::make('$money($input)'))
                            ->numeric()

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_featured')
                    ->label('Photo')
                    ->circular()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(isIndividual: false, isGlobal: true),
                Tables\Columns\IconColumn::make('featured')
                    ->alignCenter()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_state')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Draft' => 'danger',
                        'Published' => 'success'
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('d-m-Y H:i')
                    //->since()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('publish_price')
                    ->alignCenter()
                    ->money('EUR', divideBy: 100),
                //->summarize(Tables\Columns\Summarizers\Sum::make()),
                Tables\Columns\TextColumn::make('user.name')
                    ->url(fn (Animal $animal): string => UserResource::getUrl('edit', ['record' => $animal->user_id]))
                    ->sortable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('animal_type')
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('size')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('breed')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('sterilized')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('chipped')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('passport')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('vaccinated')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('rabies')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('medicins')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('special_food')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('behavioural_problem')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('kids_friendly')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('cats_friendly')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('dogs_friendly')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('well_behaved')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('playful')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('everybody_friendly')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('affectionate')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])->defaultSort('created_at', 'desc')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Publish')
                    ->icon('heroicon-m-pencil-square')
                    ->color('info')
                    ->form([
                        Forms\Components\TextInput::make('publish_price')
                            ->label('Price')
                            ->prefix('EUR')
                            ->default(function (Animal $record) {
                                return $record->publish_price / 100;
                            }),

                        Forms\Components\TextInput::make('vouchers.code')
                            ->label('Voucher')
                            ->visible(function (Animal $record) {
                                return $record->activeVouchers()->first() ? true : false;
                            })
                    ])
                    ->action(function (Animal $animal, array $data): void {
                        dd($animal->activeVouchers()->first());

                        if (!$animal->activeVouchers()->first() == null) {
                            // there is an active voucher for this animal, continue to process
                            // if the provided code is the same as the code for the active voucher, continue to process
                            // if the active voucher is not redeemed yet, continue to process
                            // if the animal is not published yet, continue to process


                            if ($data['vouchers']['code'] == $animal->vouchers->first()->code && $animal->vouchers->first()->redeemed_at == null && $animal->published_state != 'Published') {
                                if ($animal->vouchers->first()->discount == '10 percent discount') {
                                    $new_price = $animal->publish_price * 0.90;
                                }
                                if ($animal->vouchers->first()->discount == '50 percent discount') {
                                    $new_price = $animal->publish_price * 0.50;
                                }
                                if ($animal->vouchers->first()->discount == '2 euro discount') {
                                    $new_price = $animal->publish_price - 2;
                                }
                                if ($animal->vouchers->first()->discount == '10 euro discount') {
                                    $new_price = $animal->publish_price - 10;
                                }
                                $animal->published_state = AnimalPublishState::Published;
                                $animal->publish_price = $new_price;

                                $animal->vouchers->first()->redeemed_at = Carbon::now()->format('Y-m-d H:i:s');
                                $animal->vouchers->first()->status = 'inactive';
                                $animal->vouchers->first()->save();
                                $animal->save();
                                Notification::make()
                                    ->title('Success')
                                    ->success('')
                                    ->body('Voucher applied successfully and animal published successfully')
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Error')
                                    ->danger()
                                    ->body('One of three errors occurred <br> 
                                            1) Voucher was already redeemed <br> 
                                            2) you have used an invalid voucher <br> 
                                            3) Animal was published already  <br> 
                                            => Therefor, animal was not published')
                                    ->send();
                            }
                        } else {
                            $animal->published_state = AnimalPublishState::Published;
                            $animal->save();
                            Notification::make()
                                ->title('Success')
                                ->success('')
                                ->body('Animal published successfully')
                                ->send();
                        }
                    })
                    ->visible(function (Animal $record) {
                        return $record->published_state == 'Draft' ? true : false;
                    }),

            ])









            ->headerActions([
                // Tables\Actions\Action::make('New Animal')
                //     ->url(fn (): string => AnimalResource::getUrl('create'))
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
            'view' => Pages\ViewAnimal::route('/{record}'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Animal::count();
        //return Animal::whereDate('created_at', today())->count() ? 'NEW' : '';
    }
}
