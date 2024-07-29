<?php

namespace App\Filament\App\Resources\TicketResource\Pages;

use App\Filament\App\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;


class ListTickets extends ListRecords
{
    public $rec;

    public $recid;

    protected $queryString = ['rec', 'recid'];

    protected ?Model $recInstance;

    public function mount(): void
    {
        parent::mount();
        $this->recInstance = ($this->rec && $this->recid)
            ? $this->rec::findOrFail($this->recid)
            : null;
    }

    public static function getResource(): string
    {
        return TicketResource::class;
    }

    protected function getActions(): array
    {
        if (config('tickets.is_strictly_interacted') && empty($this->rec)) {
            return [];
        } else {
            return [
                CreateAction::make()->url(route(
                    'filament.app.resources.tickets.create',
                    ['tenant' => auth()->user()->organization()->id, 'rec' => $this->rec, 'recid' => $this->recid]
                )),
            ];
        }
    }

    public function getTableHeading(): Htmlable|null
    {
        return ($this->rec && $this->recid)
            ? new HtmlString(__('Tickets') . ' [<b><em>' .
                $this->recInstance->{$this->recInstance->model_name()}
                . '</em></b>]')
            : null;
    }

    protected function getTableQuery(): Builder
    {
        if (config('tickets.use_authorization')) {
            $user = auth()->user();

            if ($user->can('manageAllTickets', Ticket::class)) {
                $builder = parent::getTableQuery();
            } elseif ($user->can('manageAssignedTickets', Ticket::class)) {
                $builder = parent::getTableQuery()->where('assigned_to_id', $user->id);
            } else {
                $builder = parent::getTableQuery()->where('user_id', $user->id);
            }
        } else {
            $builder = parent::getTableQuery();
        }

        return ($this->rec && $this->recid)
            ? $builder
                ->where('ticketable_type', $this->rec)
                ->where('ticketable_id', $this->recid)
            : $builder;
    }

    public function getTitle(): string
    {
        return __('tickets.labels');
    }
}
