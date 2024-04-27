<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeCategoryRequest;
use App\Http\Resources\TypeCategoryResource;
use App\Models\TypeCategory;

class TypeCategoryController extends Controller
{
    //Возвращает коллекцию всех категорий типов.
    public function index()
    {
        return TypeCategoryResource::collection(TypeCategory::all());
    }

    //Создает новую категорию типа.
    public function store(TypeCategoryRequest $request)
    {
        return TypeCategory::create($request->validated());
    }

    //Возвращает информацию о конкретной категории типа.
    public function show(TypeCategory $typeCategory)
    {
        return $typeCategory;
    }

    //Обновляет информацию о конкретной категории типа.
    public function update(TypeCategoryRequest $request, TypeCategory $typeCategory)
    {
        $typeCategory->update($request->validated());

        return $typeCategory;
    }

    //Удаляет категорию типа.
    public function destroy(TypeCategory $typeCategory)
    {
        $typeCategory->delete();

        return response()->json();
    }
}
