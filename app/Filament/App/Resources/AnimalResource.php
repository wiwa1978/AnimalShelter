<?php

namespace App\Filament\App\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Forms\Components\MarkdownEditor;
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
use App\Models\Organization;
use App\Enums\AnimalLocation;
use Filament\Facades\Filament;
use App\Enums\AnimalAdoptionFee;
use Filament\Resources\Resource;
use App\Enums\AnimalPublishState;
use App\Enums\AnimalApprovalState;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\App\Widgets\StatsOverview;
use App\Filament\App\Resources\AnimalResource\Pages;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use App\Filament\App\Resources\AnimalResource\RelationManagers;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $tenantOwnershipRelationshipName = 'organization';


    public static function getModelLabel(): string
    {
        return __('animals_back.animal');
    }

    public static function canCreate(): bool
    {
        $organization = Organization::find(2);
        $plan = $organization->getPlan();
        
        // if the animal count is higher than the plan limit, then disable the button
        // if the organization is not free forever (hence is billable), then disable the create button
        //dd($organization->animals->count() >= $plan->options['animals'] && !$organization->isFreeForever());
        if ($organization->animals->count() >= $plan->options['animals'] && !$organization->isFreeForever()) {
            return false;
        }
        else {
            return true;
        }

    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }


    public static function getPluralModelLabel(): string
    {
        return __('animals_back.my_animals');
    }

    public static function getNavigationBadge(): ?string
    {
        $animalCount = Filament::getTenant()->animals()->count();
        return $animalCount;
  
    }

    public static function form(Form $form): Form
    {
  
        return $form
            ->schema([
                Grid::make(4)
                ->schema([
                    Section::make(__('animals_back.publish_info'))
                    ->schema([
                        // Toggle::make('featured')
                        //     ->label(__('animals_back.featured'))
                        //     ->required(),
                        
                        Toggle::make('published')
                            ->label(__('animals_back.published'))
                            ->disabled()
                            ->required(),

                        Placeholder::make('featured')
                            ->label(__('animals_back.featured'))
                            ->content(fn (Animal $record): string => $record->featured == 1 ? __('animals_back.yes') : __('animals_back.no')),
                        

                        Placeholder::make('published')
                            ->label(__('animals_back.status'))
                            //->content(fn (Animal $record): string => (string)$record->published),
                            ->content(fn (Animal $record): string => $record->published == 1 ? __('animals_back.published') : __('animals_back.not_published')),
                        
                        Placeholder::make('approval_state')
                            ->label(__('animals_back.approval_state'))
                            ->content(fn (Animal $record): string => (string)$record->approval_state->value),
                    ])
                    ->columns(4)
                    ->columnSpan(4),
            
                ]) 
     
            ->visible(fn ($context): int => $context === 'edit'),

                Wizard::make([
                    Wizard\Step::make(__('animals_back.general_info'))
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                Section::make(__('animals_back.general_info'))
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('animals_back.name'))
                                            ->minLength(2)
                                            ->maxLength(100)
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                                            ->validationAttribute('full name'),

                                        Select::make('animal_type')
                                            ->label(__('animals_back.type'))
                                            ->options(AnimalType::class)
                                            ->native(false)
                                            ->preload()
                                            ->required(),
                                        
                                        RichEditor::make('description')
                                            ->label(__('animals_back.description'))
                                            ->required()
                                            ->maxLength(65535)
                                            ->columnSpanFull(),
            
                                        Select::make('current_location')
                                            ->label(__('animals_back.current_location'))
                                            ->required()
                                            ->native(false)
                                            ->preload()
                                            ->options(AnimalLocation::class),
                                        
                                        Select::make('original_location')
                                            ->label(__('animals_back.original_location'))
                                            ->required()
                                            ->native(false)
                                            ->preload()
                                            ->options(AnimalLocation::class),
                                            
                                        Select::make('gender')
                                            ->label(__('animals_back.gender'))
                                            ->required()
                                            ->preload()
                                            ->native(false)
                                            ->options(AnimalGender::class),
            
                                        Select::make('size')
                                            ->label(__('animals_back.size'))
                                            ->required()
                                            ->native(false)
                                            ->options(AnimalSize::class),

                                        TextInput::make('breed')
                                            ->label(__('animals_back.breed'))
                                            ->required()
                                            ->maxLength(255),

                                        Select::make('adoption_fee')
                                            ->label(__('animals_back.adoption_fee'))
                                            ->required()
                                            ->native(false)
                                            ->options(AnimalAdoptionFee::class),

                                        Select::make('status')
                                            ->label(__('animals_back.status'))
                                            ->required()
                                            ->native(false)
                                            ->preload()
                                            ->options(AnimalStatus::class),
            
                                        Radio::make('age')
                                            ->label(__('animals_back.age'))
                                            ->options([
                                                '0-1' => __('animals_back.zero_to_one_year') . ' ' . __('animals_back.year'),
                                                '1-2' => __('animals_back.one_to_two_years'). ' ' . __('animals_back.year'),
                                                '2-3' => __('animals_back.two_to_three_years'). ' ' . __('animals_back.year'),
                                                '3-4' => __('animals_back.three_to_four_years'). ' ' . __('animals_back.year'),
                                                '4-5' => __('animals_back.four_to_five_years'). ' ' . __('animals_back.year'),
                                                '5-6' => __('animals_back.five_to_six_years'). ' ' . __('animals_back.year'),
                                                '6-7' => __('animals_back.six_to_seven_years'). ' ' . __('animals_back.year'),
                                                '7-8' => __('animals_back.seven_to_eight_years'). ' ' . __('animals_back.year'),
                                                '8-9' => __('animals_back.eight_to_nine_years'). ' ' . __('animals_back.year'),
                                                '9-10' => __('animals_back.nine_to_ten_years'). ' ' . __('animals_back.year'),
                                                '> 10' => __('animals_back.older_than_ten_years'). ' ' . __('animals_back.year'),
                                                '> 15' => __('animals_back.older_than_fifteen_years'). ' ' . __('animals_back.year'),
                                            ])
                                            ->columns(4)
                                            ->columnSpanFull()
                                            //->gridDirection('row')
                                            ->required(),
                                            ]),
                                    

                            ])
                     ]),
            

                    Wizard\Step::make(__('animals_back.medical_social_info'))
                    ->schema([
                        Grid::make(4)
                        ->schema([
                            Section::make(__('animals_back.medical_social_info'))
                            ->schema([
                                Toggle::make('sterilized')
                                    ->label(__('animals_back.sterilized'))
                                    ->required(),
                                Toggle::make('chipped')
                                    ->label(__('animals_back.chipped'))
                                    ->required(),
                                Toggle::make('passport')
                                    ->label(__('animals_back.passport'))
                                    ->required(),
                                Toggle::make('vaccinated')
                                    ->label(__('animals_back.vaccinated'))
                                    ->required(),
                                Toggle::make('rabies')
                                    ->label(__('animals_back.rabies'))
                                    ->required(),
                                Toggle::make('medicins')
                                    ->label(__('animals_back.medicins'))
                                    ->required(),
                                Toggle::make('special_food')
                                    ->label(__('animals_back.special_food'))
                                    ->required(),
                                Toggle::make('behavioural_problem')
                                    ->label(__('animals_back.behaviour_problem'))
                                    ->required(),
                                Toggle::make('kids_friendly_6y')
                                    ->label(__('animals_back.kids_friendly_6y'))
                                    ->required(),
                                Toggle::make('kids_friendly_14y')
                                    ->label(__('animals_back.kids_friendly_14y'))
                                    ->required(),
                                Toggle::make('cats_friendly')
                                    ->label(__('animals_back.cat_friendly'))
                                    ->required(),
                                Toggle::make('dogs_friendly')
                                    ->label(__('animals_back.dog_friendly'))
                                    ->required(),
                                Toggle::make('well_behaved')
                                    ->label(__('animals_back.well_behaved'))
                                    ->required(),
                                Toggle::make('playful')
                                    ->label(__('animals_back.playful'))
                                    ->required(),
                                Toggle::make('everybody_friendly')
                                    ->label(__('animals_back.everybody_friendly'))
                                    ->required(),
                                Toggle::make('affectionate')
                                    ->label(__('animals_back.affectionate'))
                                    ->required(),
                                Toggle::make('needs_garden')
                                    ->label(__('animals_back.needs_garden'))
                                    ->required(),
                                Toggle::make('potty_trained')
                                    ->label(__('animals_back.potty_trained'))
                                    ->required(),
                                Toggle::make('needs_movement')
                                    ->label(__('animals_back.needs_movement'))
                                    ->required(),
                                Toggle::make('car_friendly')
                                    ->label(__('animals_back.car_friendly'))
                                    ->required(),
                                Toggle::make('home_alone')
                                    ->label(__('animals_back.home_alone'))
                                    ->required(),
                                Toggle::make('knows_commands')
                                    ->label(__('animals_back.knows_command'))
                                    ->required(),
                                Toggle::make('experience_required')
                                    ->label(__('animals_back.experience_required'))
                                    ->required(),
    
                                MarkdownEditor::make('environment')
                                    ->label(__('animals_back.environment'))
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull(),


                            ])
                            ->columns(3)
                            ->columnSpan(4),
                        ])

                    ]),


                    Wizard\Step::make(__('animals_back.media'))
                    ->schema([
                        Grid::make(4)
                        ->schema([   
                            Section::make(__('animals_back.photo_title'))
                            ->schema([
                                FileUpload::make('photo_featured')
                                    ->label(__('animals_back.photo_featured'))
                                    ->acceptedFileTypes($types = ['jpg', 'jpeg', 'png'])
                                    ->image()
                                    ->maxSize(15000) // Set the maximum size of files that can be uploaded, in kilobytes.
                                    ->directory(fn ($get) => str_replace(' ', '', 'media/' . $get('name')))
                                    ->imageEditor()
                                    ->columnSpan('full'),
                                
                                FileUpload::make('photos_additional')
                                    ->label(__('animals_back.photos_additional'))
                                    ->multiple()
                                    ->directory(fn ($get) => str_replace(' ', '', 'media/' . $get('name')))
                                    ->reorderable()
                                    ->appendFiles()
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageResizeTargetWidth('800')
                                    ->imageResizeTargetHeight('600')
                                    ->imageCropAspectRatio('16:9')
                                    ->maxFiles(20)
                                    ->columnSpan('full')
                            ])
                            ->columnSpan(2),

                            Section::make(__('animals_back.video_title'))
                            ->schema([               
                                FileUpload::make('videos')
                                    ->label(__('animals_back.videos'))
                                    ->multiple()
                                    ->maxSize(50000)
                                    ->maxFiles(4)
                                    ->acceptedFileTypes($types = ['video/mp4'])
                                    ->directory(fn ($get) => str_replace(' ', '', 'media/' . $get('name')))
                                    ->previewable(true)
                                    ->columnSpan('full'),

                                Repeater::make('youtube_links')
                                    ->label(__('animals_back.youtube_links'))
                                    ->schema([
                                        TextInput::make('youtube_links')
                                            ->label(__('animals_back.youtube_link'))
                            
                                    ])
                                    ->addActionLabel('Add Youtube Link')
                                    ->maxItems(6)
                                    
                            ])
                            ->columnSpan(2),
                        ])
                    ]),
               
               
               
               
               ])->columnSpanFull(),




              
           
    



        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
            
                    ImageColumn::make('photo_featured')
                        ->label(__('animals_back.photo'))
                        ->circular(),
                    
                    TextColumn::make('animal_type')
                        ->label(__('animals_back.type'))
                        ->sortable()
                        ->searchable(),
        
                    TextColumn::make('name')
                        ->label(__('animals_back.name'))
                        ->sortable()
                        ->searchable(isIndividual: false, isGlobal: true),
        
                    IconColumn::make('featured')
                        ->label(__('animals_back.featured'))
                        ->alignCenter()
                        ->sortable()
                        ->boolean(),
        
                    TextColumn::make('published_state')
                        ->label(__('animals_back.published'))
                        ->badge()
                        ->color(fn (AnimalPublishState $state): string => match ($state->value) {
                            AnimalPublishState::DRAFT->value => 'warning',
                            AnimalPublishState::PUBLISHED->value => 'success',
                            AnimalPublishState::UNPUBLISHED->value => 'danger',
                            //'Draft' => 'warning',
                            //'Published' => 'success',
                            //'Unpublished' => 'danger'
                        })
                        ->sortable()
                        ->searchable(),
        
                    TextColumn::make('approval_state')
                        ->label(__('animals_back.approved'))
                        ->badge()
                        ->color(fn (AnimalApprovalState $state): string => match ($state->value) {
                            AnimalApprovalState::INREVIEW->value => 'warning',
                            AnimalApprovalState::APPROVED->value => 'success',
                            AnimalApprovalState::NOTAPPROVED->value => 'danger'
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
                        ->label(__('animals_back.current_location'))
                        ->sortable()
                        ->searchable(),
        
                    TextColumn::make('age')
                        ->label(__('animals_back.age'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->sortable()
                        ->searchable(),
        
                    TextColumn::make('gender')
                        ->label(__('animals_back.gender'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->sortable()
                        ->searchable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('status')
                        ->label(__('animals_back.status'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->sortable()
                        ->searchable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('size')
                        ->label(__('animals_back.size'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->searchable(),

                    TextColumn::make('breed')
                        ->label(__('animals_back.breed'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->searchable(),

                    IconColumn::make('sterilized')
                        ->label(__('animals_back.sterilized'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),
                    
                    IconColumn::make('chipped')
                        ->label(__('animals_back.chipped'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('passport')
                        ->label(__('animals_back.passport'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('vaccinated')
                        ->label(__('animals_back.vaccinated'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),
                    
                    IconColumn::make('rabies')
                        ->label(__('animals_back.rabies'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('medicins')
                        ->label(__('animals_back.medicins'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),
                    
                    IconColumn::make('special_food')
                        ->label(__('animals_back.special_food'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),
                    
                    IconColumn::make('behavioural_problem')
                        ->label(__('animals_back.behaviour_problem'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('kids_friendly_6y')
                        ->label(__('animals_back.kids_friendly_6y'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),
                    
                    IconColumn::make('kids_friendly_14y')
                        ->label(__('animals_back.kids_friendly_14y'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('cats_friendly')
                        ->label(__('animals_back.cat_friendly'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),
                    
                    IconColumn::make('dogs_friendly')
                        ->label(__('animals_back.dog_friendly'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('well_behaved')
                        ->label(__('animals_back.well_behaved'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('playful')
                        ->label(__('animals_back.playful'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('everybody_friendly')
                        ->label(__('animals_back.everybody_friendly'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    IconColumn::make('affectionate')
                        ->label(__('animals_back.affectionate'))
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->boolean(),

                    TextColumn::make('created_at')
                        ->label(__('animals_back.created_at'))
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('updated_at')
                        ->label(__('animals_back.updated_at'))
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
        
                    ]
            )->defaultSort('created_at', 'desc') 
            ->filters([
                Tables\Filters\Filter::make('featured')
                    ->label(__('animals_back.featured'))
                    ->query(fn (Builder $query): Builder => $query->where('featured', true)),

                Tables\Filters\Filter::make('sterilized')
                    ->label(__('animals_back.sterilized'))
                    ->query(fn (Builder $query): Builder => $query->where('sterilized', true)),

                Tables\Filters\Filter::make('chipped')
                    ->label(__('animals_back.chipped'))
                    ->query(fn (Builder $query): Builder => $query->where('chipped', true)),

                Tables\Filters\Filter::make('passport')
                    ->label(__('animals_back.passport'))
                    ->query(fn (Builder $query): Builder => $query->where('passport', true)),

                Tables\Filters\Filter::make('vaccinated')
                    ->label(__('animals_back.vaccinated'))
                    ->query(fn (Builder $query): Builder => $query->where('vaccinated', true)),

                Tables\Filters\Filter::make('rabies')
                    ->label(__('animals_back.rabies'))
                    ->query(fn (Builder $query): Builder => $query->where('rabies', true)),

                Tables\Filters\Filter::make('medicins')
                    ->label(__('animals_back.medicins'))
                    ->query(fn (Builder $query): Builder => $query->where('medicins', true)),

                Tables\Filters\Filter::make('special_food')
                    ->label(__('animals_back.special_food'))
                    ->query(fn (Builder $query): Builder => $query->where('special_food', true)),

                Tables\Filters\Filter::make('behavioural_problem')
                    ->label(__('animals_back.behavioural_problem'))
                    ->query(fn (Builder $query): Builder => $query->where('behavioural_problem', true)),

                Tables\Filters\Filter::make('kids_friendly_6y')
                    ->label(__('animals_back.kids_friendly_6y'))
                    ->query(fn (Builder $query): Builder => $query->where('kids_friendly_6y', true)),
                
                Tables\Filters\Filter::make('kids_friendly_14y')
                    ->label(__('animals_back.kids_friendly_14y'))
                    ->query(fn (Builder $query): Builder => $query->where('kids_friendly_14y', true)),

                Tables\Filters\Filter::make('cats_friendly')
                    ->label(__('animals_back.cat_friendly'))
                    ->query(fn (Builder $query): Builder => $query->where('cats_friendly', true)),

                Tables\Filters\Filter::make('dog_friendly')
                    ->label(__('animals_back.dog_friendly'))
                    ->query(fn (Builder $query): Builder => $query->where('dogs_friendly', true)),

                Tables\Filters\Filter::make('published_at')
                    ->label(__('animals_back.published_at'))
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->label(__('animals_back.published_from'))
                            ->native(false),
                        Forms\Components\DatePicker::make('published_until')
                            ->label(__('animals_back.published_to'))
                            ->native(false),
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
                        ->icon('heroicon-o-trash')
                        ->action(fn (Animal $record) => $record->delete())
                        ->requiresConfirmation(),
                    
                    Tables\Actions\Action::make('Publish')
                        ->requiresConfirmation()
                        ->icon('heroicon-m-pencil-square')
                        ->color('info')
                        ->action(function (Animal $animal, array $data): void {
                            $animal->published_state = AnimalPublishState::PUBLISHED;
                            $animal->published_at = Carbon::now()->format('Y-m-d H:i:s');
                            $animal->save();
                            
                            $recipient = Auth::user();
                           
                            Notification::make()
                                ->title('Animal published')
                                ->body('Animal ' . $animal->name . ' published successfully')
                                // ->actions([
                                //     Action::make('Mark As Read')
                                //         ->button()
                                //         ->markAsRead()     
                                // ])
                                ->sendToDatabase($recipient);

                            event(new DatabaseNotificationsSent($recipient));
                        })
                        ->visible(function (Animal $record) {
                            return $record->approval_state->value == AnimalApprovalState::APPROVED->value ||  $record->published_state->value == AnimalPublishState::UNPUBLISHED->value ? true : false; 
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
                            return $record->published_state == 'Gepubliceerd' ? true : false;
                        }),
                ])
                ->iconButton()
                ->button()
                ->label('Actions')
                ->icon('heroicon-m-ellipsis-horizontal')
                ->color('primary'),
                
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
