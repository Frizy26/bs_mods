<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        //Возвращает коллекцию всех заказов.
        return OrderResource::collection(Order::all());
    }

    public function store(OrderRequest $request)
    {
        //Создает новый заказ.
        return Order::create($request->validated());
    }

    public function show(Order $order)
    {
        //Возвращает информацию о конкретном заказе.
        return $order;
    }

    public function update(OrderRequest $request, Order $order)
    {
        //Обновляет информацию о конкретном заказе
        $order->update($request->validated());

        return $order;
    }

    public function destroy(Order $order)
    {
        //Удаляет заказ.
        $order->delete();

        return response()->json();
    }

    public function payOrder(Request $request, $orderId)
    {
        // Находим заказ
        $order = Order::findOrFail($orderId);

        // Проверяем, оплачен ли уже заказ
        if ($order->is_paid) {
            return response()->json(['error' => 'Заказ уже оплачен'], 400);
        }

        // Проводим логику оплаты заказа (ваша логика здесь)

        // После успешной оплаты обновляем статус заказа на оплаченный
        $order->update([
            'is_paid' => true,
        ]);

        return response()->json(['message' => 'Заказ успешно оплачен'], 200);
    }
}
