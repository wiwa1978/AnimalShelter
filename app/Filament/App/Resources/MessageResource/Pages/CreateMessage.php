<?php

namespace App\Filament\App\Resources\MessageResource\Pages;

use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\App\Resources\MessageResource;
use Filament\Notifications\Events\DatabaseNotificationsSent;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['message']['organization_id'] = Filament::getTenant()->id;


        $record = static::getModel()::create($data);
        $record->messages()->create($data['message']);

        $recipient = Auth::user();

        Notification::make()
            ->title('Connversation published')
            ->body('Conversation with subject ' . $record->subject . ' saved successfully');

        //->sendToDatabase($recipient);

        //event(new DatabaseNotificationsSent($recipient));

        return $record;
    }

}
