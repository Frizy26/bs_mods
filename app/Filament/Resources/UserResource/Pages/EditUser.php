<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
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
            $this->redirect($this->getResource()::getUrl('index'));
        }
    }
}
