<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        return Product::create($request->validated());
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }

    public function filter(Request $request, $type_category_id)
    {
        // Поиск товара по заданному идентификатору
        $product = Product::findOrFail($type_category_id);

        // Получение категории товара
        $category = $product->category()->where('id', $type_category_id)->first();

        // Проверка наличия категории
        if (!$category) {
            return response()->json(['error' => 'Нет таких товаров'], 404);
        }

        // Фильтрация товаров по категории
        $filteredProducts = Product::where('type_category_id', $type_category_id)->get();

        // Возвращение коллекции ресурсов отфильтрованных товаров
        return ProductResource::collection($filteredProducts);
    }
}
