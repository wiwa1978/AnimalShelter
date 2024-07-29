<?php

namespace App\Filament\App\Resources\TicketResource\Pages;

use App\Events\NewTicket;
use App\Filament\App\Resources\TicketResource;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    public $rec;

    public $recid;

    protected $queryString = ['rec', 'recid'];

    protected static bool $canCreateAnother = false;

    public static function getResource(): string
    {
        return TicketResource::class;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->rec && $this->recid) {
            $data['ticketable_type'] = $this->rec;
            $data['ticketable_id'] = $this->recid;
        }

        $data['user_id'] = auth()->id();
        $data['identifier'] = strtoupper(Str::random(8));
        $data['status'] = 1; // first state

        return $data;
    }

    public function getSubheading(): ?string
    {
        if ($this->rec) {
            $recInstance = $this->rec::findOrFail($this->recid);

            return $recInstance->{$recInstance->model_name()};
        } else {
            return null;
        }
    }

    protected function afterCreate(): void
    {
        NewTicket::dispatch($this->record);
    }

    public function getTitle(): string
    {
        return __('Create Ticket');
    }
}
