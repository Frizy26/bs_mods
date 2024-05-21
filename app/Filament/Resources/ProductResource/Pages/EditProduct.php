<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditProduct extends EditRecord
{
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
                                FileUpload::make('image')->image()->disk('public')->required(),
                            ])
                            ->createItemButtonLabel('Добавить изображение')
                            ->columnSpan(2)->grid(2)->deleteAction(
                                function (Action $action) {
                                    $action->modalHeading("Вы действительно хотите удалить запись?")->action(function ($state, $arguments) {
                                        if (isset($state[$arguments["item"]])) {
                                            $this->deleteVolume($state[$arguments["item"]]);
                                        }
                                    });
                                }
                            )->required(),
                    ]),
            ]);
    }

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

        DB::transaction(function () use ($data) {
            $this->record->update($data);

            $existingImagePaths = $this->record->images->pluck('image')->toArray();

            $imagesData = collect($data['images'])->unique('image')->values();
            $newImages = $imagesData->reject(function ($imageData) use ($existingImagePaths) {
                return in_array($imageData['image'], $existingImagePaths);
            });

            $this->record->images()->saveMany($newImages->map(function ($imageData) {
                return new ProductImage($imageData);
            }));
        });

        Notification::make()
            ->title('Изменения сохранены')
            ->success()
            ->send();

        $this->refreshState();
    }

    public function deleteVolume($item): void
    {
        if (!isset($item['id'])) {
            $this->refreshState();
            return;
        }

        ProductImage::find($item['id'])->delete();
        Notification::make()->title("Изображение удалено")->success()->send();
        $this->refreshState();
    }
}
