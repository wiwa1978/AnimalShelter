<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Invitation;
use Filament\Actions\Action;
use Filament\Pages\Dashboard;
use Filament\Facades\Filament;
use Filament\Pages\SimplePage;
use Filament\Support\Colors\Color;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\VoidType;
use Filament\Forms\Components\TextInput;
use Illuminate\Validation\Rules\Password;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Concerns\InteractsWithFormActions;

class AcceptInvitation extends SimplePage
{
    use InteractsWithForms;
    use InteractsWithFormActions;

    protected static string $view = 'components.livewire.accept-invitation';

    public int $invitation;
    private Invitation $invitationModel;

    public ?array $data = [];

    public function mount(): void
    {
        $this->invitationModel = Invitation::findorFail($this->invitation);

        $this->form->fill([
            'email' => $this->invitationModel->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Naampje')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),

                TextInput::make('email')
                    ->label('Emailtje')
                    ->disabled(),

                TextInput::make('password')
                    ->label('Wachtwoord')
                    ->password()
                    ->required()
                    ->rule(Password::default())
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->same('passwordConfirmation')
                    ->validationAttribute('password_confirmation'),

                TextInput::make('passwordConfirmation')
                    ->label('Wachtwoord Confirmatie')
                    ->password()
                    ->required()
                    ->dehydrated(false)

                ])
                ->statePath('data');
    }

    public function create(): void
    {
    
        $this->invitationModel = Invitation::find($this->invitation);

        $user = User::create([
            'name' => $this->form->getState()['name'],
            'email' => $this->invitationModel->email,
            'email_verified_at' => Carbon::now(),
            'password' =>Hash::make($this->form->getState()['password']),
            'organization_type' => $this->invitationModel->organization_type,
            'invited' => true,
            'invited_at' => Carbon::now(),
        ]);

        $user->assignRole('user');
        $user->organizations()->attach($this->invitationModel->organization_id);

        //auth()->login($user);

       

        $this->invitationModel->delete();

       // redirect()->to(filament.app.auth.login);
        //Filament::getPanel('app')->auth()->login($user);
        
        if (Filament::getPanel()->getId() === 'admin') {
            Filament::getPanel('app')->auth()->login($user);
            $this->redirect(route('filament.app.resources.animals.index', ['tenant' => $this->invitationModel->organization_id]));
            session()->regenerate();
        }

        session()->regenerate();
        

    }
    protected function getFormActions(): array
    {
        return [
            $this->getRegisterFormAction(),
        ];
    }

    public function getRegisterFormAction(): Action
    {
        return Action::make('register')
            ->label(__('filament-panels::pages/auth/register.form.actions.register.label'))
            ->button()
            ->color(Color::hex('#BE123C'),)
            ->submit('register');
    }

    public function getHeading(): string
    {
        return 'Accept invitation';
    }

    public function hasLogo(): bool
    {
        return false;
    }

    public function getSubHeading(): string
    {
        return 'Create your user to accept an invitation';
    }
}
