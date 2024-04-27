<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Получаем поисковый запрос из запроса пользователя
        $query = $request->input('query');

        // Выполняем поиск товаров, у которых название или комментарий содержат запрос
        $products = Product::where('title', 'like', '%' . $query . '%')
            ->orWhere('comment', 'like', '%' . $query . '%')
            ->get();

        // Возвращаем представление с найденными товарами
        return view('search', compact('products', 'query'));
    }
}
