<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Путь к "домашнему" маршруту вашего приложения.
     *
     * Как правило, пользователи перенаправляются сюда после аутентификации.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Определите привязки к модели маршрута, фильтры шаблонов и другую конфигурацию маршрута.
     */
    protected $namespace = 'App\\Http\\Controllers\\';

    //Загрузка дополнительных условий маршрутизации приложения.
    public function boot(): void
    {
        // Определение ограничений для API маршрутов
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Определение маршрутов для приложения
        $this->routes(function () {
            // Группа маршрутов API с префиксом 'api-mods'
            Route::middleware('api')
                ->prefix('api-mods')
                ->group(base_path('routes/api.php'));

            // Группа маршрутов для веб-приложения
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
