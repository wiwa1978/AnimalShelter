<?php

namespace App\Filament\Admin\Resources;

use App\Models\Ticket;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Admin\Resources\TicketResource\Pages;
use App\Filament\Admin\Resources\TicketResource\RelationManagers\CommentsRelationManager;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $tenantOwnershipRelationshipName = 'user';

    protected static ?string $tenantRelationshipName = 'users';

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function getModelLabel(): string
    {
        return __('tickets.label');
    }


    public static function getPluralModelLabel(): string
    {
        return __('tickets.labels');
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Support';
    }

    public static function form(Form $form): Form
    {
        $user = auth()->user();

        $statuses = array_map(fn ($e) => __($e), config('tickets.statuses'));
        $priorities = array_map(fn ($e) => __($e), config('tickets.priorities'));

        return $form
            ->schema([
                Card::make([
                    Placeholder::make('User Name')
                        ->label(__('tickets.username'))
                        ->content(fn ($record) => $record?->user->name)
                        ->hiddenOn('create'),
                    Placeholder::make('User Email')
                        ->label(__('tickets.useremail'))
                        ->content(fn ($record) => $record?->user->email)
                        ->hiddenOn('create'),
                    TextInput::make('title')
                        ->label(__('tickets.title'))
                        ->translateLabel()
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2)
                        ->disabledOn('edit'),
                    RichEditor::make('content')
                        ->label(__('tickets.content'))
                        ->translateLabel()
                        ->required()
                        ->columnSpan(2)
                        ->disabledOn('edit'),
                    Select::make('status')
                        ->translateLabel()
                        ->options($statuses)
                        ->required()
                        // ->disabled(fn ($record) => (
                        //     $cannotManageAllTickets &&
                        //     ($cannotManageAssignedTickets || $record?->assigned_to_id != $user->id)
                        // ))
                        ->hiddenOn('create'),
                    Select::make('priority')
                        ->label(__('tickets.priority'))
                        ->translateLabel()
                        ->options($priorities)
                        ->disabledOn('edit')
                        ->required(),
                    Select::make('assigned_to_id')
                        ->label(__('tickets.assignto'))
                        ->hint(__('tickets.assignto_info'))
                        ->searchable()
                        ->getSearchResultsUsing(function ($search) {
                            if (strlen($search) < 3) {
                                return [];
                            }

                            return config('tickets.user-model')::where('name', 'like', "%{$search}%")
                                ->limit(50)
                                ->get()
                                ->filter(fn ($user) => $user->can('manageAssignedTickets', Ticket::class))
                                ->pluck('name', 'id');
                        })
                        ->getOptionLabelUsing(fn ($value): ?string => config('tickets.user-model')::find($value)?->name)
                        ->disabled(false)
                        ->hiddenOn('create'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = auth()->user();

        if (config('tickets.use_authorization')) {
            $canManageAllTickets = $user->can('manageAllTickets', Ticket::class);
            $canManageAssignedTickets = $user->can('manageAssignedTickets', Ticket::class);
        } else {
            $canManageAllTickets = true;
            $canManageAssignedTickets = true;
        }

        $statuses = array_map(fn ($e) => __($e), config('tickets.statuses'));
        $priorities = array_map(fn ($e) => __($e), config('tickets.priorities'));

        return $table
            ->columns([
                TextColumn::make('identifier')
                    ->label(__('tickets.identifier'))
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label(__('tickets.username_from'))
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label(__('tickets.title'))
                    ->translateLabel()
                    ->searchable()
                    ->words(8),
                TextColumn::make('status')
                    ->translateLabel()
                    ->formatStateUsing(fn ($record) => $statuses[$record->status] ?? '-'),
                TextColumn::make('priority')
                    ->label(__('tickets.priority'))
                    ->translateLabel()
                    ->formatStateUsing(fn ($record) => $priorities[$record->priority] ?? '-')
                    ->color(fn ($record) => $record->priorityColor()),
                TextColumn::make('assigned_to.name')
                    ->label(__('tickets.assignedto'))
                    ->translateLabel()
                    ->visible($canManageAllTickets || $canManageAssignedTickets),
                TextColumn::make('created_at')
                    ->label(__('tickets.created_at'))
                    ->dateTime('d-m-Y H:i:s')
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label(__('tickets.updated_at'))
                    ->dateTime('d-m-Y H:i:s')
                    ->searchable(),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                Filter::make('filters')
                    ->form([
                        Select::make('status')
                            ->translateLabel()
                            ->options($statuses),
                        Select::make('priority')
                            ->translateLabel()
                            ->options($priorities),
                    ])
                    ->query(
                        fn (Builder $query, array $data) => $query
                        ->when($data['status'], fn ($query, $status) => $query->where('status', $status))
                        ->when($data['priority'], fn ($query, $priority) => $query->where('priority', $priority))
                    ),
            ])
            ->actions([
                ActionGroup::make([   
                    //ViewAction::make(),
                    EditAction::make()
                        ->color('secondary')
                        ->visible($canManageAllTickets || $canManageAssignedTickets),
                ])
                //->icon('heroicon-m-ellipsis-horizontal')
                ->color('primary')
               
            ])
            ->bulkActions([
                // DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
