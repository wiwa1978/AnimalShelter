<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Auth\RegisterOrganization;
use App\Http\Middleware\VerifyIsOrganization;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AppOrgPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('app-org')
            ->path('app-org')
            ->colors([
                'primary' => Color::Amber,
            ])
            
            ->login()
            ->registration(RegisterOrganization::class)
            ->userMenuItems([
                // MenuItem::make()
                //     ->label('Admin Panel')
                //     ->icon('heroicon-o-cog-6-tooth')
                //     ->url('/admin')
                //     ->visible(fn () => Auth::user()->isSuperAdmin()),
                MenuItem::make()
                    ->label('My Profile')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/app/my-profile')
            ])
            ->discoverResources(in: app_path('Filament/AppOrg/Resources'), for: 'App\\Filament\\AppOrg\\Resources')
            ->discoverPages(in: app_path('Filament/AppOrg/Pages'), for: 'App\\Filament\\AppOrg\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/AppOrg/Widgets'), for: 'App\\Filament\\AppOrg\\Widgets')
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
                VerifyIsOrganization::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
