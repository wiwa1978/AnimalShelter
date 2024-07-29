<?php

namespace App\Filament\App\Resources\TicketResource\RelationManagers;


use App\Models\Ticket;
use App\Models\Comment;
use Filament\Forms\Form;
use App\Events\NewComment;
use Filament\Tables\Table;
use App\Events\NewResponse;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Livewire\Component as LivewireComponent;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    protected static ?string $recordTitleAttribute = 'user.name';

    public static function getModelLabel(): string
    {
        return __('tickets.comment');
    }


    public static function getPluralModelLabel(): string
    {
        return __('tickets.comments');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextArea::make('content')->required(),
            ]);
    }

    public  function table(Table $table): Table
    {
        $user = auth()->user();

        return $table
            ->paginated(true)
            ->columns([
                Stack::make([
                    Split::make([
                        TextColumn::make('user.name')
                            ->label(__('tickets.username'))
                            ->translateLabel()
                            ->weight('bold')
                            ->color(fn (LivewireComponent $livewire, Model $record) => $livewire->ownerRecord->user_id == $record->user_id ? 'primary' : 'success')
                            ->grow(false),
                        TextColumn::make('created_at')
                            ->label(__('tickets.created_at'))
                            ->translateLabel()
                            ->dateTime('d-m-Y - H:i:s')
                            ->color('secondary'),
                    ]),
                    TextColumn::make('content')
                        ->label(__('tickets.content'))
                        ->wrap(),
                ]),
            ])
            ->headerActions([
                Action::make('addComment')
                    ->label(__('tickets.add_comment'))
                    ->form([
                        RichEditor::make('content')
                            ->label(__('tickets.comment'))
                            ->translateLabel()
                            ->required(),
                    ])
                    ->action(function (array $data, LivewireComponent $livewire) use ($user): void {
                        $ticket = $livewire->ownerRecord;
                        abort_unless(
                            config('tickets.use_authorization') == false ||
                            $ticket->user_id == $user->id ||
                            $ticket->assigned_to_id == $user->id ||
                            $user->can('manageAllTickets', Ticket::class),
                            403
                        );
                        $comment = Comment::create([
                            'content' => $data['content'],
                            'user_id' => $user->id,
                            'ticket_id' => $livewire->ownerRecord->id,
                        ]);
                        if ($livewire->ownerRecord->user_id == $user->id) {
                            NewComment::dispatch($comment);
                        } else {
                            NewResponse::dispatch($comment);
                        }
                    }),
            ])
            ->defaultSort('id', 'desc');
    }


    // public static function getTitle(): string
    // {
    //     return null;
    // }
}
