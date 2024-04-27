<?php

use App\Http\Resources\{TypeCategoryResource, ProductResource, OrderResource, CartResource, FavouriteResource};
use App\Http\Controllers\{GetController, OrderController, CartController, ProductController, TypeCategoryController, AuthUserController, FavouriteController};
use App\Models\{TypeCategory, Product, Order, Cart, Favourite};
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Маршруты API
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать маршруты API для вашего приложения. Эти
| маршруты загружаются через RouteServiceProvider, и все они будут
| присвоены группе промежуточного ПО "api". Сделайте что-то замечательное!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Тип категории продукта
Route::controller(TypeCategoryController::class)->group(function () {
    Route::get('/type-category', 'index');
});

//Продукты
Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index');
    Route::get('/product/{id}', 'show');
    Route::get('/product/category/{type_category_id}', 'filter');
});

//Заказы
Route::controller(OrderController::class)->group(function () {
   Route::get('/order', 'index')->middleware('auth:sanctum');
});

//Корзина
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->middleware('auth:sanctum');
    Route::post('/cart/add-product/{id}', 'addItem')->middleware('auth:sanctum');
    Route::delete('/cart/delete-product/{productId}', 'removeItem')->middleware('auth:sanctum');
});


//API-TOKEN
Route::post('/personal-access-tokens', [PersonalAccessToken::class, 'store'])->middleware('auth:sanctum');
Route::delete('/personal-access-tokens/{tokenId}', [PersonalAccessToken::class, 'delete'])->middleware('auth:sanctum');


