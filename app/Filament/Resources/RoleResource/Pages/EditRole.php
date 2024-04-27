<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Livewire\Form;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

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
