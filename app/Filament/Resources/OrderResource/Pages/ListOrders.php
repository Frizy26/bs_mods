<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = OrderResource::class;

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Действие "Создать"
        ];
    }
}
