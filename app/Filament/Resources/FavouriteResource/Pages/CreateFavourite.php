<?php

namespace App\Filament\Resources\FavouriteResource\Pages;

use App\Filament\Resources\FavouriteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFavourite extends CreateRecord
{
    protected static string $resource = FavouriteResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
