<?php

namespace App\Providers\Filament;


use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Models\Organization;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Navigation\NavigationItem;
use App\Filament\App\Pages\Auth\Register;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\App\Pages\Auth\EmailVerification;
//use Filament\Billing\Providers\SparkBillingProvider;
//use App\Http\Middleware\VerifyOrganizationIsBillable;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use App\Filament\App\Pages\Auth\RequestYourPasswordReset;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Filament\App\Pages\Tenancy\EditOrganizationProfile;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;


class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        
        return $panel
            ->id('app')
            ->path('app')
        
            ->darkMode(true)
            ->navigationItems([
                NavigationItem::make('Mijn gegevens')
                    ->url(fn() => '/app/'. auth()->user()->organizations()->first()->id . '/profile')
                    ->group('Gebruikersbeheer')
                    ->icon('heroicon-o-user-circle'),
                // NavigationItem::make('Abonnement')
                //     ->url(fn() => '/billing/organization/' . auth()->user()->organizations()->first()->id)
                //     ->group('Gebruikersbeheer')
                //     ->icon('heroicon-o-banknotes')
                //     ->visible(fn() => env('BILLING_ENABLED', true)),
            ])
            ->brandName('Animals')
            ->brandLogo(asset('storage/images/logo3.svg'))
            ->favicon(asset('storage/images/logo3.svg'))
            //->tenantBillingProvider(new SparkBillingProvider())
            //->tenantBillingRouteSlug('billing')
            //->requiresTenantSubscription()
            ->tenant(Organization::class, ownershipRelationship: 'organizations')
            //->tenantRegistration(RegisterOrganization::class)
            ->tenantMenu(false)
            ->tenantProfile(EditOrganizationProfile::class)
            ->tenantMiddleware([
                //ApplyTenantScopes::class,
            ], isPersistent: true)
            ->login()
            ->registration(Register::class) 
            ->passwordReset(RequestYourPasswordReset::class)
            ->emailVerification(EmailVerification::class)
            ->spa()
            ->databaseNotifications()
            ->databaseNotificationsPolling('10s')
            ->unsavedChangesAlerts()
            ->databaseTransactions()
            ->colors([
                'primary' => Color::hex('#BE123C'),  //#881337
                'danger' => Color::Red, 
                'success' => Color::Green,
                'warning' => Color::Yellow,
                'info' => Color::Blue,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Back to website')
                    ->icon('heroicon-o-link')
                    ->url('/'),
                MenuItem::make()
                    ->label('Admin Panel')
                    ->icon('heroicon-o-link')
                    ->url('/admin')
                    ->visible(fn () => auth()->user()->isSuperAdmin()),
                MenuItem::make()
                    ->label('Mijn gegevens')
                    ->icon('heroicon-o-user-circle')
                    ->url(fn() => '/app/'. auth()->user()->organizations()->first()->id . '/profile'),
                MenuItem::make()
                    ->label(fn() => 'Mijn profiel')
                    //->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle')                    //If you are using tenancy need to check with the visible method where ->company() is the relation between the user and tenancy model as you called
                    ->url(fn() => '/app/'. auth()->user()->organizations()->first()->id . '/my-profile')
                    
                    ->visible(function (): bool {
                        return auth()->check();
                    }),
                // MenuItem::make()
                //     ->label('Abonnement')
                //     ->icon('heroicon-o-banknotes')
                //     ->url(fn() => '/billing/organization/' . auth()->user()->organizations()->first()->id)
                    //->visible(fn() => env('BILLING_ENABLED', true)),
                ])

            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth(MaxWidth::Full)
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])

            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                
            ])
            ->plugins([
                \Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin::make()
                    ->color('#BE123C'),
                \Kenepa\Banner\BannerPlugin::make()
                    ->persistsBannersInDatabase()
                    ->disableBannerManager(),
                    \MarcoGermani87\FilamentCookieConsent\FilamentCookieConsent::make(),
                    \Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin::make()
                        ->slug('my-profile')
                        ->setTitle(__('users_back.my_user_profile'))
                        ->setNavigationLabel(__('users_back.user_profile'))
                        ->setNavigationGroup(__('users_back.user_management'))
                        ->setIcon('heroicon-o-user')
                        // ->setSort(10)
                        // ->canAccess(fn () => auth()->user()->id === 1)
                        //->shouldRegisterNavigation(false)
                        ->shouldShowDeleteAccountForm(true)
                        //->shouldShowSanctumTokens()
                        ->shouldShowBrowserSessionsForm()
                        //->shouldShowAvatarForm()
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                //VerifyOrganizationIsBillable::class,
                
            ])
            ->authMiddleware([
                Authenticate::class,
                //RedirectIfNotFilamentAuthenticated::class,
            ])
            ->renderHook(
                // This line tells us where to render it
                'panels::body.end',
                // This is the view that will be rendered
                fn () => view('livewire.customFooter'),
            );
            //->tenantRoutePrefix('organization')
            //->topNavigation()
            //->sidebarFullyCollapsibleOnDesktop()

    }
}
