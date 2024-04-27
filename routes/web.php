<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Веб-маршруты
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать веб-маршруты для вашего приложения. Эти
| маршруты загружаются через RouteServiceProvider, и все они будут
| присвоены группе промежуточного ПО "web". Сделайте что-то замечательное!
|
*/

//Регистрация
Route::post('/register', [AuthUserController::class, 'store'])->middleware('guest');

//Авторизация
Route::post('/login', [AuthUserController::class, 'login']);

//Деавторизация
Route::delete('/logout', [AuthUserController::class, 'logout'])->middleware('auth');

//Поисковая строка
Route::get('/search', [SearchController::class, 'search'])->name('search');
