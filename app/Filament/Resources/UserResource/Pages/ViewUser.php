<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = UserResource::class;

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(), // Действие "Редактировать"
        ];
    }
}
