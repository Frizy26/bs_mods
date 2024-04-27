<?php

namespace App\Filament\Resources\TypeCategoryResource\Pages;

use App\Filament\Resources\TypeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTypeCategory extends ViewRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = TypeCategoryResource::class;

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(), // Действие "Редактировать"
        ];
    }
}
