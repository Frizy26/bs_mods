<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersStatsAdminChart extends ChartWidget
{
    //Заголовок виджета.
    protected static ?string $heading = 'Статистика';

    //Цвет виджета.
    protected static string $color = 'info';

    //Количество столбцов, занимаемых виджетом в макете.
    protected int | string | array $columnSpan = [
      'md' => 2,
        'xl' => 2,
    ];

    //Фильтр данных для графика.
    public ?string $filter = 'year';

    //Получает данные для построения графика.
    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        $activeFilter = $this->filter;
        return [
            'datasets' => [
                [
                    'label' => 'Пользователей зарегистрировалось',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    //Получает доступные фильтры для выбора диапазона данных на графике.
    protected function getFilters(): ?array
    {
        return [
            'today' => 'За сегодня',
            'week' => 'За неделю',
            'month' => 'За месяц',
            'year' => 'За год',
        ];
    }

    //Возвращает тип графика.
    protected function getType(): string
    {
        return 'line';
    }
}
