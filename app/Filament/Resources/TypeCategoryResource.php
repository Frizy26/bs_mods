<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeCategoryResource\Pages;
use App\Filament\Resources\TypeCategoryResource\RelationManagers;
use App\Models\TypeCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeCategoryResource extends Resource
{
    // Модель, связанная с ресурсом.
    protected static ?string $model = TypeCategory::class;

    // Иконка для навигации к ресурсу.
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    // Метка для навигации к ресурсу.
    protected static ?string $navigationLabel = 'Категории';

    // Группа для навигации к ресурсу.
    protected static ?string $navigationGroup = 'Управление товарами';

    // Определяет форму для создания и редактирования записей.
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    // Определяет таблицу для отображения записей.
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Получает связанные ресурсы.
    public static function getRelations(): array
    {
        return [
            // Здесь могут быть определены связанные ресурсы
        ];
    }

    // Получает страницы ресурса.
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeCategories::route('/'),
            'create' => Pages\CreateTypeCategory::route('/create'),
            'view' => Pages\ViewTypeCategory::route('/{record}'),
            'edit' => Pages\EditTypeCategory::route('/{record}/edit'),
        ];
    }
}
