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
    protected function getStats(): array
    {
        return [
            Stat::make('Пользователи', User::query()->count())
                ->description('Зарегистрированных пользователей')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Заказы', Cart::query()->count())
                ->description('Всего созданных заказов')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),
            Stat::make('Товаров на сайте', Product::query()->count())
                ->description('Доступных товаров')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
        ];

    }
}
