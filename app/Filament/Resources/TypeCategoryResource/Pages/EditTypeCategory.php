<?php

namespace App\Filament\Resources\TypeCategoryResource\Pages;

use App\Filament\Resources\TypeCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeCategory extends EditRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = TypeCategoryResource::class;

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(), // Действие "Просмотр"
            Actions\DeleteAction::make(), // Действие "Удаление"
        ];
    }
    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        $data = $this->form->getState();

        // Примените изменения к данным
        $this->record->update($data);

        // Сохраните модель, если нужно
        $this->record->save();

        // Опционально: выполните дополнительные действия после сохранения

        if ($shouldRedirect) {
            // Перенаправление пользователя после сохранения
            $this->redirect($this->getResource()::getUrl('index'));
        }
    }
}
