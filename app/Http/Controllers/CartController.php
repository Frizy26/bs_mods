<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(Cart::all());
    }

    public function store(CartRequest $request)
    {
        return Cart::create($request->validated());
    }

    public function show(Cart $cart)
    {
        return $cart;
    }

    public function update(CartRequest $request, Cart $cart)
    {
        $cart->update($request->validated());

        return $cart;
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json();
    }

    public function addItem(Request $request, $id)
    {
        // Получаем информацию о товаре
        $product = Product::query()->findOrFail($id);

        $user = Auth::user();

        // Используем firstOrCreate для создания нового заказа, если он не существует
        $order = $user->orders()->where('is_paid', false)->firstOrCreate([
            'user_id' => $user->id,
            'total_price' => $product->price,
        ]);

        // Используем create для создания нового элемента корзины
        $cartItem = $order->carts()->create([
            'product_id' => $id,
        ]);

        // Возвращаем ответ в виде JSON с кодом состояния 201
        return response()->json([
            'product' => $product,
            'cart_item' => $cartItem,
        ], 201);
    }

    public function removeItem(Request $request, $productId)
    {

        // Получаем текущего пользователя
        $user = Auth::user();

        // Ищем текущий неоплаченный заказ пользователя
        $order = $user->orders()->where('is_paid', false)->first();
        if (!$order) {
            return response()->json(['error' => 'Нет активных заказов'], 404);
        }

        // Ищем товар в корзине пользователя
        $cartItem = $order->carts()->where('id', $productId)->first();
        if (!$cartItem) {
            return response()->json(['error' => 'Продукт не найден в корзине'], 404);
        }

        // Удаляем товар из корзины
        $cartItem->delete();

        // Проверяем, остались ли еще товары в заказе
        if ($order->carts->isEmpty()) {
            // Если товаров не осталось, удаляем заказ
            $order->delete();
        }

        return response()->json(['message' => 'Продукт удален из корзины'], 200);
    }
}
