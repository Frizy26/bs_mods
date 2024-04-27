<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = UserResource::class;

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(), // Действие "Просмотр"
            Actions\DeleteAction::make(), // Действие "Удаление"
        ];
    }

    // Метод сохранения записи.
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
