<?php

// lang/en/messages.php

return [
    'user' => 'User',
    'users' => 'Users',
    'user_management' => 'User Management',
    'user_profile' => 'User Profile',
    'my_user_profile' => 'My Profile',
    'users_overview' => 'Overview teammembers',
];



// Grid::make(4)
// ->schema([
//     Section::make('Adresgegevens')
//         ->schema([
//             TextInput::make('name')
//             ->label('Naam')
//             ->required(),
        
//             TextInput::make('billing_address')
//                 ->label('Adres')
//                 ->required(),

//             TextInput::make('billing_postal_code')
//                 ->label('Postcode')
//                 ->required(),

//             TextInput::make('billing_city')
//                 ->label('Stad/Gemeente')
//                 ->required(),

//             TextInput::make('billing_state')
//                 ->label('Provincie')
//                 ->required(),

//             Select::make('billing_country')
//                 ->label('Land')
//                 ->required()
//                 ->native(false)
//                 ->options(Country::class),

//         ])
//         ->columnSpan(2),


    
//     Section::make('Gegevens betreffende de organisatie')
//         ->schema([
//             TextInput::make('organization_name')
//             ->label('Naam van de organisatie')
//             ->required(),

//             TextInput::make('organization_website')
//                 ->label('Website van de organisatie')
//                 ->required(),

//             TextInput::make('phone')
//                 ->label('Phone'),

//             TextInput::make('email')
//                 ->label('Persoonlijk emailadres')
//                 ->required(),

//             TextInput::make('invoice_emails')
//                 ->label('Emailadres voor facturatie')
//                 ->required(),

//             TextInput::make('vat_id')
//                 ->label('BTW nummer')
//                 ->required()


//         ])
//         ->visible(fn (Organization $record): bool => $record->organizationIsShelter() || $record->organizationIsOrganization())
//         ->columnSpan(2),

//     Section::make('Huidig Plan')
//         ->schema([
//             DateTimePicker::make('trial_ends_at')
//                 ->label('Proefperiode eindigt op')
//                  ->native(false)
//                 ->displayFormat('d-m-Y')
//                 ->visible(fn (): bool => auth()->user()->organizations()->first()->trial_ends_at !== null),
            
//             Placeholder::make('Huidig abonnement')
//                 ->content(fn (Organization $record): string => $record->getPlan()->name),