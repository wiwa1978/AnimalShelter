<?php

namespace App\Filament\App\Pages\Tenancy;

use App\Enums\Country;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\DateTimePicker;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditOrganizationProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Jouw profiel';
    }

    public function getTitle(): string | Htmlable
    {
        $organization_type = auth()->user()->organizations()->first()->is_shelter ? "Asiel" : "Particulier";
        //return 'Jouw profiel' ;
        return 'Jouw profiel (' . $organization_type . ')';
    }

    public function form(Form $form): Form
    {
        //$organization = auth()->user()->organizations()->first();
        //$subscription = $organization->subscriptions()->first()->stripe_price;
        //dd($organization->subscriptions()->first()->stripe_price);

        return $form
            ->schema([
                Grid::make(4)
                ->schema([
                    Section::make('Adresgegevens')
                        ->schema([
                            TextInput::make('name')
                            ->label('Name')
                            ->required(),
                        
                            TextInput::make('billing_address')
                                ->label('Adres')
                                ->required(),
        
                            TextInput::make('billing_postal_code')
                                ->label('Postcode')
                                ->required(),
        
                            TextInput::make('billing_city')
                                ->label('Stad/Gemeente')
                                ->required(),
        
                            TextInput::make('billing_state')
                                ->label('Provincie')
                                ->required(),
        
                            Select::make('billing_country')
                                ->label('Country')
                                ->required()
                                ->native(false)
                                ->options(Country::class),

                        ])
                        ->columnSpan(2),

                    Section::make('Huidig Plan')
                        ->schema([
                            DateTimePicker::make('trial_ends_at')
                                ->label('Proefperiode eindigt op')
                                 ->native(false)
                                ->displayFormat('d-m-Y')
                             
                            
                            // TextInput::make($subscription)
                            //     ->label('Abonnement')
                            //     ->readonly(),
                            
                            
                        ])
                        ->columnSpan(2),
                    
                        Section::make('Gegevens betreffende de organisatie')
                        ->schema([
                            TextInput::make('shelter_name')
                            ->label('Naam van de organisatie')
                            ->required(),

                            TextInput::make('shelter_website')
                                ->label('Website van de organisatie')
                                ->required(),

                            TextInput::make('phone')
                                ->label('Phone'),

                            TextInput::make('email')
                                ->label('Persoonlijk emailadres')
                                ->required(),

                            TextInput::make('invoice_emails')
                                ->label('Emailadres voor facturatie')
                                ->required(),

                            TextInput::make('vat_id')
                                ->label('BTW nummer')
                                ->required()


                        ])
                        ->visible(fn (): bool => auth()->user()->organizations()->first()->is_shelter)
                        ->columnSpan(2),

                    
                   
                ]),
            ]);
 
    }
}
