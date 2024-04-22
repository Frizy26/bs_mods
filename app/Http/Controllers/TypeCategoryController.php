<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeCategoryRequest;
use App\Http\Resources\TypeCategoryResource;
use App\Models\TypeCategory;

class TypeCategoryController extends Controller
{
    public function index()
    {
        return TypeCategoryResource::collection(TypeCategory::all());
    }

    public function store(TypeCategoryRequest $request)
    {
        return TypeCategory::create($request->validated());
    }

    public function show(TypeCategory $typeCategory)
    {
        return $typeCategory;
    }

    public function update(TypeCategoryRequest $request, TypeCategory $typeCategory)
    {
        $typeCategory->update($request->validated());

        return $typeCategory;
    }

    public function destroy(TypeCategory $typeCategory)
    {
        $typeCategory->delete();

        return response()->json();
    }
}
