<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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
        $product = Product::findOrFail($id);


        // Вычисляем стоимость за один товар
        $itemPrice = $product->price;

        // Получаем идентификатор текущего пользователя
        $userid = Auth::id();

        // Создаем новую запись в таблице carts
        $cartItem = new Cart();
        $cartItem->user_id = $userid;; // Устанавливаем user_id
        $cartItem->product_id = $id;
        $cartItem->order_id = $id;

        // Сохраняем запись
        $cartItem->save();

        // Возвращаем ответ в виде JSON
        return response()->json([
            'message' => 'Товар успешно добавлен в корзину',
            'total_price' => $product->price
        ]);
    }

    public function delete(Request $request, $productId)
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
