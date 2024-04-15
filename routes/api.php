<?php

use App\Http\Resources\{TypeCategoryResource, ProductResource, OrderResource};
use App\Http\Controllers\{GetController, OrderController, CartController};
use App\Models\{TypeCategory, Product};
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


Route::get('/type_categories/{id}', function (string $id){
    return new TypeCategoryResource(TypeCategory::findOrFail($id));
});

Route::get('/products/{id}', function (string $id){
    return new ProductResource(Product::findOrFail($id));
});

Route::get('/products', function () {
    return ProductResource::collection(Product::all());
});

Route::controller(OrderController::class) ->group(function () {
   Route::get('/order', 'index');
});

Route::controller(CartController::class) ->group(function () {
    Route::get('/cart', 'index');
});
