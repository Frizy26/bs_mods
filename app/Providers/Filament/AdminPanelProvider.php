<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws \Exception
     */

    //Создает и настраивает панель администратора Filament.
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin') // Уникальный идентификатор панели
            ->path('admin') // Путь к панели
            ->login() // Включает страницу входа
            ->colors([ // Настройка цветовой схемы панели
                'primary' => Color::Amber,
            ])
            ->favicon(asset('images/logo.png')) // Путь к иконке favicon
            ->brandLogo(asset('images/logo.png')) // Путь к логотипу
            ->brandName(asset('BS-Mods')) // Название бренда
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources') // Обнаружение ресурсов Filament
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages') // Обнаружение страниц Filament
            ->pages([
                // Добавление страниц в панель
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets') // Обнаружение виджетов Filament
            ->widgets([
                // Добавление виджетов в панель
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                // Промежуточные слои HTTP для панели
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
                // Промежуточные слои аутентификации для панели
                Authenticate::class,
            ]);
    }
}
