<?php

namespace App\Http\Controllers;

use App\Http\Queries\ProductQuery;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Support\Pagination\PageBuilderFactory;
use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //Возвращает коллекцию всех товаров.
    public function index(PageBuilderFactory $pageBuilderFactory, ProductQuery $query): Responsable
    {
        return ProductResource::collectPage(
            $pageBuilderFactory->fromQuery($query)->build()
        );
    }

    //Создает новый товар.
    public function store(ProductRequest $request)
    {
        return Product::create($request->validated());
    }

    //Возвращает информацию о конкретном товаре.
    public function show(Product $product)
    {
        return $product;
    }

    //Обновляет информацию о конкретном товаре.
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return $product;
    }

    //Удаляет товар.
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }

    //Фильтрует товары по категории.
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
