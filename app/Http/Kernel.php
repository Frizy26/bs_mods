<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Глобальный стек промежуточного программного обеспечения HTTP приложения.
     *
     * Это промежуточное программное обеспечение запускается при каждом запросе к вашему приложению.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class, // Доверие прокси
        \Illuminate\Http\Middleware\HandleCors::class, // Обработка CORS
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // Предотвращение запросов во время обслуживания
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // Проверка размера POST запроса
        \App\Http\Middleware\TrimStrings::class, // Удаление лишних пробелов в строках
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Преобразование пустых строк в null
    ];

    /**
     * Группы промежуточного программного обеспечения маршрутизации приложения.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // Шифрование cookies
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Добавление в ответ ожидающих cookies
            \Illuminate\Session\Middleware\StartSession::class, // Начало сессии
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Передача ошибок из сессии в представления
            \App\Http\Middleware\VerifyCsrfToken::class, // Проверка CSRF токена
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Замена связей
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // Обеспечение состояния для запросов из фронтенда
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api', // Ограничение скорости запросов для API
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Замена связей
        ],
    ];

    /**
     * Псевдонимы промежуточного программного обеспечения приложения.
     *
     * Псевдонимы могут использоваться вместо имен классов для удобного назначения промежуточного программного обеспечения маршрутам и группам.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class, // Аутентификация
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // Аутентификация через HTTP Basic
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, // Аутентификация сессии
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // Установка заголовков кэша
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // Проверка доступа по разрешениям
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Перенаправление, если пользователь аутентифицирован
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // Подтверждение пароля перед выполнением действия
        'signed' => \App\Http\Middleware\ValidateSignature::class, // Проверка подписи
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Ограничение скорости запросов
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Проверка подтверждения email
    ];
}
