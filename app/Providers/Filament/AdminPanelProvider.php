<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CustomLogin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;
use App\Filament\Pages\Settings\Settings;
use Edwink\FilamentUserActivity\FilamentUserActivityPlugin;
use Edwink\FilamentUserActivity\Http\Middleware\RecordUserActivity;
use Filament\Support\Enums\MaxWidth;
use Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(false)
            ->darkMode(false)
            ->profile(isSimple: false)
            // ->brandName('DB Careers')
            // ->databaseNotifications()
            ->spa()
            ->font('Poppins')
            ->maxContentWidth(MaxWidth::Full)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::hex('#36c'),
                'danger' => Color::Red,
                'gray' => Color::Zinc,
                'info' => Color::Blue,
                'success' => Color::Green,
                'warning' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            // ->widgets([
            //     PostOverview::class,
            //     ResponsesOverview::class,
            // Widgets\AccountWidget::class,
            // Widgets\FilamentInfoWidget::class,

            // ])
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
                RecordUserActivity::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentGeneralSettingsPlugin::make()
                    ->canAccess(fn () => auth()->user()->role === 'ADMIN')
                    ->setSort(3)
                    ->setIcon('heroicon-o-cog')
                    ->setNavigationGroup('Settings')
                    ->setTitle('General Settings')
                    ->setNavigationLabel('General Settings'),
                FilamentBackgroundsPlugin::make()
                ->showAttribution(false)
                ->remember(5000)
                // ->imageProvider(
                //     MyImages::make()
                //         ->directory('images/backgrounds')
                // )
                ,
                FilamentFullCalendarPlugin::make()
            ])
            // ->resources([
            //     config('filament-logger.activity_resource')
            // ])
        ;
    }
}
