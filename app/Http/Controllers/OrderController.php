<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

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
}
