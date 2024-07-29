<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Filament\Admin\Resources\AnimalResource\Pages\ApprovalAnimal;
use App\Filament\Admin\Resources\AnimalResource\Widgets\AnimalOverviewChart;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->databaseNotifications()
            ->default()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandName('Lief Dier - Lief Thuis')
            ->brandLogo(asset('storage/images/icon_logo.svg'))
            ->favicon(asset('storage/images/icon_logo.svg'))
            ->spa()
            //->login()
            ->path('admin')
            ->colors([
                'primary' => Color::Red,   // #88 13 37
                'secondary' => Color::hex('#312E81'),  // #49 46 129
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Application Dashboard')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/app'),
            ])
            ->navigationItems([
                NavigationItem::make('Mijn Approvals')
                    ->url(fn (): string => ApprovalAnimal::getUrl())
                    ->icon('heroicon-o-presentation-chart-line')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.resources.animals.approval'))
                    ->badge(fn () => ApprovalAnimal::getNavigationBadge())
                  
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                AnimalOverviewChart::class
            ])
            ->plugins([
                \Rmsramos\Activitylog\ActivitylogPlugin::make()
                    ->label('Activiteiten Log')
                    ->pluralLabel('Activiteiten Logs (Ramos)')
                    ->navigationGroup('Logs')
                    // ->authorize(
                    //     fn () => auth()->user()->id === 1
                    // ) 
                ,
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                \Howdu\FilamentRecordSwitcher\FilamentRecordSwitcherPlugin::make(),
                \Joaopaulolndev\FilamentEditEnv\FilamentEditEnvPlugin::make()
                    //->showButton(fn () => auth()->user()->id === 1)
                    ->setIcon('heroicon-o-cog'),
                \Joaopaulolndev\FilamentCheckSslWidget\FilamentCheckSslWidgetPlugin::make()
                    ->domains([
                        'wymedia.be',

                    ])
                    ->setTitle('Certificates') 
                    ->setDescription('SSL certificate detail'), 
                    //->setColumnSpan('full')
                    \Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin::make(),
                    \Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin::make()->color('#BE123C'),
                    \Kenepa\Banner\BannerPlugin::make()
                        ->persistsBannersInDatabase()
                        ->navigationIcon('heroicon-o-megaphone')
                        ->navigationLabel('Banners')
                        ->navigationGroup('Marketing'),
                    \Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin::make()
                        //->canAccess(fn() => auth()->user()->id === 1)
                        ->setSort(3)
                        ->setIcon('heroicon-o-cog')
                        ->setNavigationGroup('Gebruikersbeheer')
                        ->setTitle('Algemene Instellingen')
                        ->setNavigationLabel('Algemene Instellingen'),
                    \Tapp\FilamentMailLog\FilamentMailLogPlugin::make(),
                    \Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin::make()
                        ->slug('my-profile')
                        ->setTitle(__('users_back.my_user_profile'))
                        ->setNavigationLabel(__('users_back.user_profile'))
                        ->setNavigationGroup(__('users_back.user_management'))
                        ->setIcon('heroicon-o-user')
                        ->setSort(4)
                        // ->canAccess(fn () => auth()->user()->id === 1)
                        //->shouldRegisterNavigation(false)
                        ->shouldShowDeleteAccountForm(false)
                        //->shouldShowSanctumTokens()
                        ->shouldShowBrowserSessionsForm(),
                        //->shouldShowAvatarForm()

                        \Amendozaaguiar\FilamentRouteStatistics\FilamentRouteStatisticsPlugin::make(),
                        \Brickx\MaintenanceSwitch\MaintenanceSwitchPlugin::make(),
                        \Saade\FilamentLaravelLog\FilamentLaravelLogPlugin::make()
                            ->navigationGroup('System Tools')
                            ->navigationLabel('Logs')
                            ->navigationIcon('heroicon-o-bug-ant')
                            ->navigationSort(1)
                            ->slug('logs')
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
            ])
            ->authMiddleware([
                Authenticate::class,
                //RedirectIfNotFilamentAuthenticated::class,
            ]);
    }
}
