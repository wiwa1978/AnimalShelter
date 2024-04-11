<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Models\Organization;
use App\Http\Middleware\OnTrial;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use App\Filament\App\Pages\Auth\Register;
use App\Http\Middleware\ApplyTenantScopes;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\CheckTenantSubscription;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Billing\Providers\SparkBillingProvider;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\App\Pages\Tenancy\RegisterOrganization;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Filament\App\Pages\Tenancy\EditOrganizationProfile;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('app')
            ->path('app')
            ->darkMode(false)
            ->brandName('Animals')
            ->brandLogo(asset('storage/images/logo3.svg'))
            ->favicon(asset('storage/images/logo3.svg'))
            ->tenantBillingProvider(new SparkBillingProvider())
            ->tenantBillingRouteSlug('billing')
            ->requiresTenantSubscription()
            ->tenant(Organization::class, ownershipRelationship: 'organizations')
            //->tenantRegistration(RegisterOrganization::class)
            ->tenantProfile(EditOrganizationProfile::class)
            // ->tenantMenuItems([
            //     MenuItem::make()
            //     ->label('Settings')
            //     ->icon('heroicon-m-cog-8-tooth')
            //     ])
            // ->tenantMenuItems([
            //     'billing' => MenuItem::make()->label('Manage subscription'),
            //     // ...
            // ])
            ->tenantMenu(true)
            ->tenantMiddleware([
                ApplyTenantScopes::class,
                //CheckTenantSubscription::class,
                //OnTrial::class
            ], isPersistent: true)
            ->login()
            //->registration()
            ->registration(Register::class) 
            ->passwordReset()
            ->emailVerification()
            //->spa()
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
                ->icon('heroicon-o-cog-6-tooth')
                ->url('/'),
                MenuItem::make()
                    ->label('Admin Panel')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/admin')
                    ->visible(fn () => auth()->user()->isSuperAdmin()),
                MenuItem::make()
                    ->label('My Profile')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/app/my-profile'),
                MenuItem::make()
                    ->label('Billing')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(fn() => '/billing/organization/' . auth()->user()->organizations()->first()->id)
            ])
            //->tenantRoutePrefix('organization')
            //->topNavigation()
            ->sidebarCollapsibleOnDesktop()
            //->sidebarFullyCollapsibleOnDesktop()
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
                CheckTenantSubscription::class,
                OnTrial::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
