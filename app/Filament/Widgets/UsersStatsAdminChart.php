<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersStatsAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Статистика';

    protected static string $color = 'info';

    protected int | string | array $columnSpan = [
      'md' => 2,
        'xl' => 2,
    ];

    public ?string $filter = 'year';

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

    protected function getFilters(): ?array
    {
        return [
            'today' => 'За сегодня',
            'week' => 'За неделю',
            'month' => 'За месяц',
            'year' => 'За год',
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
