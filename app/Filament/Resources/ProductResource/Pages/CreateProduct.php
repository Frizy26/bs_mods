<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\ProductImage;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    // Указание ресурса, с которым связана страница.
    protected static string $resource = ProductResource::class;

    // Схема формы
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

    public function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $product = static::getModel()::create($data);

        $images = collect($data['images'])->map(function ($imageData) use ($product) {
            return new ProductImage($imageData + ['product_id' => $product->id]);
        });
        $product->images()->saveMany($images);

        return $product;
    }
}
