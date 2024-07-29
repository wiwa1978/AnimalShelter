<?php

namespace App\Filament\App\Resources\TicketResource\Pages;

use Filament\Actions;
use App\Events\NewAssignment;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\TicketResource;

class EditTicket extends EditRecord
{
    public $prev_assigned_to_id;

    protected static string $resource = TicketResource::class;

    protected function getActions(): array
    {
        return [Actions\DeleteAction::make()->color('primary')];
        
    }
    

    public function getTitle(): string
    {
        $interacted = $this->record?->ticketable;

        return __('Ticket') . ($interacted ? ' [' . $interacted?->{$interacted?->model_name()} . ']' : '');
    }

    protected function afterFill()
    {
        $this->prev_assigned_to_id = $this->record->assigned_to_id;
    }

    protected function afterSave()
    {
        if ($this->record->assigned_to_id != $this->prev_assigned_to_id) {
            NewAssignment::dispatch($this->record);
        }
    }
}
