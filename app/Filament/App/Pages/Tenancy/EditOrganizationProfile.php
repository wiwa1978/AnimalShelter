<?php

namespace App\Filament\App\Pages\Tenancy;

use App\Enums\Country;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\Organization;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
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
        $organization = Organization::find(1);

        $plan = $organization->getPlan();

        $test = $plan->name; // "Free"

       

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
                                ->visible(fn (): bool => auth()->user()->organizations()->first()->trial_ends_at !== null),
                            
                            Placeholder::make('Huidig abonnement')
                                ->content(fn (Organization $record): string => $record->getPlan()->name),

                            Placeholder::make('Details van het abonnement')
                                //->content(new HtmlString('Aantal gebruikers: ' . $plan->options['users'] . '<br>Aantal dieren: ' . $plan->options['animals'] . '<br>')),
                                ->content(
                                    new HtmlString('
                                        <ul class="list-none list-inside">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 inline-block align-text-top"">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                                </svg>
                                                Aantal gebruikers: ' . $plan->options['users'] . '
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 inline-block align-text-top"">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                                </svg>
                                                Aantal dieren: ' . $plan->options['animals'] . '
                                            </li>
                                            
                                        </ul>
                                    ')),
                            
                            
                             
                            
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
