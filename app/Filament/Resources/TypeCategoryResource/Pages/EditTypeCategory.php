<?php

namespace App\Filament\Resources\TypeCategoryResource\Pages;

use App\Filament\Resources\TypeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeCategory extends EditRecord
{
    protected static string $resource = TypeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
