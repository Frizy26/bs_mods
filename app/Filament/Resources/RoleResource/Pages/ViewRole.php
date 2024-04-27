<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRole extends ViewRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = RoleResource::class;

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),  // Действие "Редактировать"
        ];
    }
}
