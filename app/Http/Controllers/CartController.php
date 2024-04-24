<?php

namespace App\Http\Controllers;

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

    public function delete(Request $request, $productId) //не работает
    {
        // Получаем текущую корзину из сессии или создаем новую
        $cart = Cart::find($request->session()->get('cart_id'));

        if (!$cart) {
            $cart = new Cart();
            $cart->save();
            $request->session()->put('cart_id', $cart->id);
        }

        // Удаляем товар из корзины
        $product = Product::find($productId);
        if ($product) {
            $cart->product()->detach($product);
        }

        // Возвращаем ответ
        return response()->json(['message' => 'Товар удален из корзины']);
    }
}
