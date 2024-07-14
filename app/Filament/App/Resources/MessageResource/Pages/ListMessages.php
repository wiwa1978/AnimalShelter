<?php

namespace App\Filament\App\Resources\MessageResource\Pages;

use Filament\Actions;
use App\Models\Message;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\App\Resources\MessageResource;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        


        $tabs = [
            // 'All Messages' => Tab::make()
            //     ->badge((string)Message::query()->count()),

            'Inbox' => Tab::make()
                ->badge(
                    Message::query()
                        ->where('receiver_email', auth()->user()->email)
                        ->count()
                    ),

            'Outbox' => Tab::make()
            ->badge(
                Message::query()
                    ->where('sender_email', auth()->user()->email)
                    ->count()
                ),

            
        ];

        return $tabs;
    }
}
