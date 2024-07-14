<?php

namespace App\Filament\Admin\Resources\AnimalResource\Pages;

//use Mansoor\FilamentVersionable\RevisionsPage;
use App\Filament\Admin\Resources\AnimalResource;



class AnimalRevisions //extends RevisionsPage
{
    protected static string $resource = AnimalResource::class;

    // public static function getPages(): array
    // {
    //     return [
    //         'revisions' => AnimalRevisions::route('/{record}/revisions'),
    //     ];
    // }
}
