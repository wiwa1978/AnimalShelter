<?php

namespace App\Filament\App\Resources\MessageResource\Pages;

use Filament\Actions;
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
        $record = static::getModel()::create($data);
        $record->messages()->create($data['message']);

        $recipient = Auth::user();

        Notification::make()
            ->title('Connversation published')
            ->body('Copnversation with subject ' . $record->subject . ' saved successfully')

            ->sendToDatabase($recipient);

        event(new DatabaseNotificationsSent($recipient));

        return $record;
    }

}
