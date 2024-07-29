<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

use Carbon\Carbon;
use App\Models\Animal;
use Filament\Tables\Table;
use App\Enums\AnimalPublishState;
use App\Enums\AnimalApprovalState;
use Filament\Actions\CreateAction;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\AnimalResource;


class ApprovalAnimal extends ListRecords
{
    
    protected static string $resource = AnimalResource::class;

    protected static string $view = 'filament.admin.pages.approval-animal';

    public function getTitle(): string
    {
        return 'Mijn Approvals';
    }

    public static function getNavigationLabel(): string
    {
        return 'Custom Navigation Label';
    }
   
    public static function getNavigationBadge(): ?string
    {
        return Animal::where('approval_state', AnimalApprovalState::INREVIEW)
            ->count();
    }

    protected function getTableQuery(): Builder
    {
        $query = Animal::query();
        $query
            ->where('approval_state', AnimalApprovalState::INREVIEW);
    
        return $query;
    }
    
    function table(Table $table): Table
    {
        return $table
        
            ->columns([
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

                TextColumn::make('published_state')
                    ->label(__('animals_back.published'))
                    ->badge()
                    ->color(fn (AnimalPublishState $state): string => match ($state->value) {
                        AnimalPublishState::DRAFT->value => 'warning',
                        AnimalPublishState::PUBLISHED->value => 'success',
                        AnimalPublishState::UNPUBLISHED->value => 'danger',
                        AnimalPublishState::REQUESTPENDING->value => 'info',

                    })
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('approval_state')
                    ->label(__('animals_back.approval_state'))
                    ->badge()
                    ->color(fn (AnimalApprovalState $state): string => match ($state->value) {
                        AnimalApprovalState::INREVIEW->value => 'info',
                        AnimalApprovalState::APPROVED->value => 'success',
                        AnimalApprovalState::NOTAPPROVED->value => 'danger',
                        AnimalApprovalState::NOTAPPLICABLE->value => 'warning'
                    })
                    ->sortable()
                    ->searchable(),

            ])
            ->actions(
                ActionGroup::make([
                    Action::make('Approve')
                    ->requiresConfirmation()
                    ->modalHeading('Aanvraag tot publicatie goedkeuren')
                    ->modalDescription('Het dier zal onmiddellijk worden gepubliceerd. De gebruiker krijgt hiervan een melding.')
                    ->modalSubmitActionLabel('Aanvraag goedkeuren')
                    ->icon('heroicon-o-hand-thumb-up')
                    ->label(__('animals_back.approve'))
                    ->color('info')
                    ->action(function (Animal $animal, array $data): void {
                        $animal->approval_state = AnimalApprovalState::APPROVED->value;
                        $animal->approved_at = Carbon::now()->format('Y-m-d H:i:s');
                        $animal->published_state = AnimalPublishState::PUBLISHED->value;
                        $animal->published_at = Carbon::now()->format('Y-m-d H:i:s');
                        $animal->save();

                        $users = $animal->organization->users;

                        foreach ($users as $user) {
                            Notification::make()
                                ->title(__('animals_back.approved_success_title', [ 'name' => $animal->name ]))
                                ->success()
                                ->sendToDatabase($user);
                        }
                    }),


                Action::make('Unapprove')
                    ->requiresConfirmation()
                    ->modalHeading('Aanvraag tot publicatie afkeuren')
                    ->modalDescription('Het dier zal niet worden gepubliceerd. De gebruiker krijgt een melding en dient eerst aanpassingen te doen alvorens een nieuwe aanvraag tot publicatie te doen.')
                    ->modalSubmitActionLabel('Aanvraag afkeuren')
                    ->label(__('animals_back.unapprove'))
                    ->icon('heroicon-o-hand-thumb-down')
                    ->color('info')
                    ->form([
                        Textarea::make('unapprove_reason')
                        ->label(__('animals_back.reason_unapprove'))
                        ->maxLength(255)
                        ->required()
                    ])
                    ->action(function (Animal $animal, array $data): void {
                        $animal->approval_state = AnimalApprovalState::NOTAPPROVED->value;
                        $animal->unapprove_reason = $data['unapprove_reason'];
                        $animal->unapproved_at = Carbon::now()->format('Y-m-d H:i:s');
                        $animal->published_state = AnimalPublishState::DRAFT->value;
                        $animal->save();

                        $users = $animal->organization->users;

                        foreach ($users as $user) {
                            Notification::make()
                                ->title(__('animals_back.unapproved_success_title', [ 'name' => $animal->name ]))
                                ->body(__('animals_back.reason', ['reason' => $data['unapprove_reason']]))
                                ->danger()
                                ->sendToDatabase($user);
                        }

                    })
                    
                ])         
                ->iconButton()
                ->button()
                ->label('Actions')
                ->icon('heroicon-m-ellipsis-horizontal')
                ->color('primary'),
                


                   
                

            );
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }
    
    protected function getDefaultTableSortDirection(): ?string
    {
        return 'dsc';
    }
    
    public static function canCreate(Model $record): bool
    {
        return false;
    }
    
    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
    

   
}
