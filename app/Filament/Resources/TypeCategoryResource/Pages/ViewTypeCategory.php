<?php

namespace App\Filament\Resources\TypeCategoryResource\Pages;

use App\Filament\Resources\TypeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTypeCategory extends ViewRecord
{
    protected static string $resource = TypeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
