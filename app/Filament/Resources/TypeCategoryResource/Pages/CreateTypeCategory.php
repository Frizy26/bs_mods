<?php

namespace App\Filament\Resources\TypeCategoryResource\Pages;

use App\Filament\Resources\TypeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeCategory extends CreateRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = TypeCategoryResource::class;
}
