<?php

namespace App\Filament\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseAuth;

class RegisterOrganization extends BaseAuth
{
    public function form(Form $form): Form
    {
        //dd($form);

        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->setOrganizationComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getOrganizationNameComponent(),
                $this->getOrganizationWebsiteComponent(),
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

    protected function setOrganizationComponent(): Component
    {
        return Hidden::make('organization')->default(true);
    }

    protected function getOrganizationNameComponent(): Component
    {
        return TextInput::make('organization_name')
            ->label('Organization Name')
            ->required();
    }

    protected function getOrganizationWebsiteComponent(): Component
    {
        return TextInput::make('website')
            ->label('Organization Website')
            ->required();
    }
}
