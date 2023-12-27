<?php

namespace App\Filament\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseAuth;

class RegisterOrganization extends BaseAuth
{
    public function form(Form $form): Form
    {
        $data['company'] = true;

        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getCompanyFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCompanyNameComponent(),
                $this->getCompanyWebsiteComponent(),
            ])
            ->statePath('data');
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label("Contact Name")
            ->required()
            ->maxLength(255)
            ->autofocus();
    }


    protected function getCompanyFormComponent(): Component
    {
        return Toggle::make('company')
            ->label('Individual or Company')
            ->required();
    }

    protected function getCompanyNameComponent(): Component
    {
        return TextInput::make('company_name')
            ->label('Company Name')
            ->required();
    }

    protected function getCompanyWebsiteComponent(): Component
    {
        return TextInput::make('website')
            ->label('Company Website')
            ->required();
    }
}
