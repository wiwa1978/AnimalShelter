<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class PaymentStatus extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.payment-status';


    protected static bool $shouldRegisterNavigation = false;
}
