<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = ProductResource::class;

    public function mount($record): void
    {
        parent::mount($record);
        $this->refreshState();
    }

    public function refreshState(): void
    {
        $images = Product::find($this->record->id)->images;

        $state = $this->form->getRawState();
        $state['images'] = $images ? $images->map->toArray()->toArray() : [];

        $this->form->fill($state);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Название продукта')->required(),
                TextInput::make('download_free')->label('Ссылка на скачивание')->required(),
                Textarea::make('comment')->label('Комментарий')->required(),
                TextInput::make('price')->label('Цена')->numeric()
                    ->required()->rules('numeric|max:9999.00|min:0|required')->prefix('₽'),
                TextInput::make('year')->label('Год')->required(),
                Select::make('type_category_id')->label('Категория')->required()
                    ->relationship('category', 'name')->native(false),


                Fieldset::make('Изображения')->columnSpan(2)
                    ->schema([
                        Repeater::make('images')->label('Изображение')
                            ->schema([
                                FileUpload::make('image')->image()->required(),
                            ])
                            ->createItemButtonLabel('Добавить изображение')
                            ->columnSpan(2)->grid(2)->required(),
                    ]),
            ]);
    }

    // Получение дополнительных действий для заголовка страницы.
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(), // Действие "Редактировать"
        ];
    }
}
