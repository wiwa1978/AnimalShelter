<?php

namespace App\Filament\App\Pages\Auth;

use App\Enums\OrganizationType;
use Filament\Pages\Page;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRoleFormComponent(), 
                    ])
                    ->statePath('data'),
            ),
        ];
    }
 
    protected function getRoleFormComponent(): Component
    {
           return Select::make('organization_type')
            // ->options([
            //     'Particulier' => 'Particulier',
            //     'Stichting' => 'Stichting',
            //     'Asiel' => 'Asiel',
            // ])
            ->options(OrganizationType::class)
            ->required();
    
    }
}
