<?php

namespace App\Filament\App\Pages\Tenancy;

use Filament\Forms\Form;
use Illuminate\Support\Str;
use App\Models\Organization;
use Faker\Provider\ar_EG\Text;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterOrganization extends RegisterTenant
{
    public static function canCreate(): bool
{
    return false;
}

    public static function getLabel(): string
    {
        return 'Register user or organisation';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name'),
                    
                    ]),
            ]);
    }

    protected function handleRegistration(array $data): Organization
    {
        $data = [
            'name' =>  $data['name'],
            'slug' => Str::slug( $data['name']),
            
        ];

        $organization = Organization::create($data);

        $organization->users()->attach(auth()->user());

        return $organization;
    }
}
