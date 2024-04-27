<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Обрабатывает входящий запрос.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Если нет аргументов, устанавливаем guard по умолчанию как null
        $guards = empty($guards) ? [null] : $guards;

        // Проверяем каждый переданный guard
        foreach ($guards as $guard) {
            // Если пользователь уже аутентифицирован в текущем guard
            if (Auth::guard($guard)->check()) {
                // Возвращаем ответ с сообщением о том, что пользователь уже зарегистрирован
                return response([
                   'message' => 'Вы уже зарегистрированны.'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        // Продолжаем выполнение запроса
        return $next($request);
    }
}
