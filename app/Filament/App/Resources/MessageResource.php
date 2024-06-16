<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Message;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Conversation;
use Filament\Facades\Filament;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Support\View\Components\Modal;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\MessageResource\Pages;
use App\FIlament\Infolists\Components\ConversationSubject;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use App\FIlament\Infolists\Components\ConversationReplyButton;
use App\Filament\App\Resources\MessageResource\RelationManagers;
use App\Filament\App\Resources\MessageResource\RelationManagers\MessagesRelationManager;
use App\Filament\App\Resources\MessageResource\RelationManagers\ConversationsRelationManager;

class MessageResource extends Resource
{
    protected static ?string $model = Conversation::class;

    protected static ?string $tenantOwnershipRelationshipName = 'user';

    protected static ?string $tenantRelationshipName = 'users';

    protected static ?string $modelLabel = 'Message';
 
    protected static ?string $navigationLabel = 'Inbox';


    public static function getEloquentQuery(): Builder {
        //return Conversation::query();
        return Conversation::query()
        ->whereHas('messages', function (Builder $query) {
            $query->where('sender_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
        });
    }


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               

                //TextInput::make('message.organization_id'),


                Hidden::make('message.sender_id')
                    ->default(auth()->id()),

                TextInput::make('subject'),

                Hidden::make('message.organization_id'),

                // Select::make('message.sender_id')
                //     ->label('Sender')
                //     ->options(User::all()->pluck('name', 'id')->toArray())
                //     ->required(),
        
                Select::make('message.receiver_id')
                    ->label('Send to')
                    ->options(User::all()->pluck('name', 'id')->toArray())
                    ->required(),

                //TextInput::make('message.content'),

                RichEditor::make('message.content')
                    ->label(__('animals_back.description'))
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),

               
                       
                          

            ]);
    }

    public static function getConversationParticipants($conversationId)
    {
       
        $conversation = Conversation::find($conversationId); 
        
        $participant1 = $conversation->messages()->first()->sender_id;
        $participant2 = $conversation->messages()->first()->receiver_id;
        $currentUserId = Auth::user()->id;
        $otherParticipant = $currentUserId == $participant1 ? $participant2 : $participant1;
        return $otherParticipant;
    }
   


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sender_id')
                    ->getStateUsing( function (Model $record){
                        return $record->messages()->first()?->sender->name;
                    })
                    ->label('Initiated by'),

                 TextColumn::make('receiver_id')
                    ->getStateUsing( function (Model $record){
                        return $record->messages()->first()?->receiver->name;
                    })
                    ->label('Receiver'),

                TextColumn::make('subject')
                    ->label('Conversation Subject'),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // public static function infolist(Infolist $infolist): Infolist
    // {
        

    //     return $infolist
    //         ->schema([
    //             Actions::make([
    //                 Action::make('reply')
    //                     ->form([
    //                         Textarea::make('content')
    //                             ->required(),
    //                     ])
    //                     ->action(function (Conversation $record, array $data): void {
                            
    //                         $test = $record->messages()->create([
    //                             'organization_id' => Filament::getTenant()->id,
    //                             'receiver_id' => (auth()->id() === $record->messages()->first()->sender_id) ? $record->messages()->first()->receiver_id : $record->messages()->first()->sender_id,
    //                             'sender_id' => auth()->id(),
    //                             'content' => $data['content'],
    //                         ]);


    //                         // Send notification to the user receiving the message
    //                         $recipient = (auth()->id() === $test['sender_id']) ? $test['receiver_id'] : $test['sender_id'];
    //                         //dd($receiver);

    //                         Log::debug('Receiver: ' . $recipient);
                            
    //                         Notification::make()
    //                             ->title('New Reply To ' . $record->subject)
    //                             ->sendToDatabase(User::find($recipient));

    //                         event(new DatabaseNotificationsSent(User::find($recipient)));
    //                     })
    //             ])
    //             ->columnSpanFull(),

    //             RepeatableEntry::make('messages')
    //                 ->hiddenLabel()
    //                 ->schema(fn () => [
    //                     Grid::make()
    //                         ->schema([
    //                             TextEntry::make('sender.name')
    //                                 ->inlineLabel(),
    //                             TextEntry::make('created_at')
    //                                 ->inlineLabel()
    //                                 ->hiddenLabel()
    //                                 ->since()
    //                                 ->alignEnd(),
    //                         ]),
    //                         TextEntry::make('content')
    //                             ->hiddenLabel(),
    //                         RichEditor::make('content')
    //                         ->label(__('animals_back.description'))
    //                 ])
    //                 ->columnSpanFull(),
                    

                
    //         ]);
    // }


    public static function getRelations(): array
    {
        return [
           // MessagesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
           

        ];
    }
}
