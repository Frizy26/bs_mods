<?php

namespace App\Filament\Widgets;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    //Получает статистику для административного обзорного виджета.
    protected function getStats(): array
    {
        return [
            // Статистика по количеству зарегистрированных пользователей
            Stat::make('Пользователи', User::query()->count())
                ->description('Зарегистрированных пользователей')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            // Статистика по количеству заказов
            Stat::make('Заказы', Cart::query()->count())
                ->description('Всего созданных заказов')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            // Статистика по количеству товаров на сайте
            Stat::make('Товаров на сайте', Product::query()->count())
                ->description('Доступных товаров')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
        ];

    }
}
