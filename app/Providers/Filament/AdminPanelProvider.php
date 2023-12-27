<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use App\Http\Middleware\VerifyIsSuperAdmin;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('Admin Interface')
            ->login()
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('User Management')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Application Dashboard')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/app'),
            ])
            ->colors([
                'primary' => Color::Red,
                'danger' => Color::Red,
                'success' => Color::Green,
                'warning' => Color::Yellow,
                'info' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
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
                //VerifyIsSuperAdmin::class,
            ])
            ->plugins(
                [
                    FilamentSpatieRolesPermissionsPlugin::make(),
                    BreezyCore::make()
                        ->myProfile(
                            shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                            shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                            hasAvatars: false, // Enables the avatar upload form component (default = false)
                            slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                        )
                ]
            )
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
