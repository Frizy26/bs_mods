<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouriteRequest;
use App\Http\Resources\FavouriteResource;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    public function index()
    {
        return FavouriteResource::collection(Favourite::all());
    }

    public function store(FavouriteRequest $request)
    {
        return new FavouriteResource(Favourite::create($request->validated()));
    }

    public function show(Favourite $favourite)
    {
        return new FavouriteResource($favourite);
    }

    public function update(FavouriteRequest $request, Favourite $favourite)
    {
        $favourite->update($request->validated());

        return new FavouriteResource($favourite);
    }

    public function destroy(Favourite $favourite)
    {
        $favourite->delete();

        return response()->json();
    }
}
