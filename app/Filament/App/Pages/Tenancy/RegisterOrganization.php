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
                        Toggle::make('is_shelter')
                            ->label('Asiel')
                            ->default(false),
                        TextInput::make('name')
                            ->label('Name'),
                        TextInput::make('streetname')
                            ->label('Streetname'),
                        TextInput::make('streetnumber')
                            ->label('Number'),
                        TextInput::make('zipcode')
                            ->label('Zip'),
                        TextInput::make('city')
                            ->label('City'),
                        TextInput::make('country')
                            ->label('Country'),
                    ]),
                Section::make('Organization specific information')
                    ->schema([
                        TextInput::make('shelter_name')
                            ->label('Shelter name'),
                        TextInput::make('shelter_website')
                            ->label('Website'),
                        TextInput::make('phone')
                            ->label('phone'),
                        TextInput::make('email')
                            ->label('email'),
                        
                    ]),
            ]);
    }

    protected function handleRegistration(array $data): Organization
    {
        $data = [
            'name' => Auth::user()->name ,
            'slug' => Str::slug(Auth::user()->name),
            'is_shelter' => $data['is_shelter'],
            'streetname' => $data['streetname'],
            'streetnumber' => $data['streetnumber'],
            'zipcode' => $data['zipcode'],
            'city' => $data['city'],
            'country' => $data['country'],
            'shelter_name' => $data['shelter_name'],
            'shelter_website' => $data['shelter_website'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            
            
        ];

        $organization = Organization::create($data);

        $organization->users()->attach(auth()->user());

        return $organization;
    }
}
