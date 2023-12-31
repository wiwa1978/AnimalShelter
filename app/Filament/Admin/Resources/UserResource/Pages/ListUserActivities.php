<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Admin\Resources\UserResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListUserActivities  extends ListActivities
{
    protected static string $resource = UserResource::class;
}
