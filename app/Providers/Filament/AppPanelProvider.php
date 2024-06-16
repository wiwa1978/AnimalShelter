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
use App\Http\Middleware\ApplyTenantScopes;
use Filament\Http\Middleware\Authenticate;

use App\Http\Middleware\CheckBillingEnabled;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Billing\Providers\SparkBillingProvider;
use App\Http\Middleware\VerifyOrganizationIsBillable;
use Illuminate\Routing\Middleware\SubstituteBindings;

use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Filament\App\Pages\Tenancy\EditOrganizationProfile;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use RalphJSmit\Filament\Notifications\FilamentNotifications;


class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        
        return $panel
            ->id('app')
            ->path('app')
            ->darkMode(false)
            ->navigationItems([
                NavigationItem::make('Profiel')
                    ->url(fn() => '/app/'. auth()->user()->organizations()->first()->id . '/profile')
                    ->group('Gebruikersbeheer')
                    ->icon('heroicon-o-user-circle'),
                NavigationItem::make('Abonnement')
                    ->url(fn() => '/billing/organization/' . auth()->user()->organizations()->first()->id)
                    ->group('Gebruikersbeheer')
                    ->icon('heroicon-o-banknotes')
                    ->visible(fn() => env('BILLING_ENABLED', true)),
            ])
            ->brandName('Animals')
            ->brandLogo(asset('storage/images/logo3.svg'))
            ->favicon(asset('storage/images/logo3.svg'))
            ->tenantBillingProvider(new SparkBillingProvider())
            ->tenantBillingRouteSlug('billing')
            ->requiresTenantSubscription()
            ->tenant(Organization::class, ownershipRelationship: 'organizations')
            //->tenantRegistration(RegisterOrganization::class)
            //->tenantMenu(false)
            ->tenantProfile(EditOrganizationProfile::class)

            ->tenantMiddleware([
                //ApplyTenantScopes::class,
            ], isPersistent: true)
            ->login()
            ->registration(Register::class) 
            ->passwordReset()
            ->emailVerification()
            ->spa()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
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
                    ->label('Profiel')
                    ->icon('heroicon-o-user-circle')
                    ->url(fn() => '/app/'. auth()->user()->organizations()->first()->id . '/profile'),
                MenuItem::make()
                    ->label('Abonnement')
                    ->icon('heroicon-o-banknotes')
                    ->url(fn() => '/billing/organization/' . auth()->user()->organizations()->first()->id)
                    ->visible(fn() => env('BILLING_ENABLED', true)),
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
                VerifyOrganizationIsBillable::class,
                
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
            //->tenantRoutePrefix('organization')
            //->topNavigation()
            //->sidebarFullyCollapsibleOnDesktop()

    }
}
