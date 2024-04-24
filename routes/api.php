<?php

use App\Http\Resources\{TypeCategoryResource, ProductResource, OrderResource, CartResource};
use App\Http\Controllers\{GetController, OrderController, CartController, ProductController, TypeCategoryController, AuthUserController};
use App\Models\{TypeCategory, Product, Order, Cart};
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    //Route::get('/get', 'GetController');
});

//Тип категории продукта
Route::controller(TypeCategoryController::class)->group(function () {
    Route::get('/type-category', 'index');
});

//Продукты
Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index');
});

//Заказы
Route::controller(OrderController::class)->group(function () {
   Route::get('/order', 'index')->middleware('auth:sanctum');
});

//Корзина
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index');
    Route::post('/cart/add-product/{id}', 'addItem');
    Route::delete('/cart/delete-product/{id}', 'destroy');
})->middleware('auth:sanctum');

//API-TOKEN
Route::post('/personal-access-tokens', [PersonalAccessToken::class, 'store'])->middleware('auth:sanctum');
Route::delete('/personal-access-tokens/{tokenId}', [PersonalAccessToken::class, 'delete'])->middleware('auth:sanctum');


