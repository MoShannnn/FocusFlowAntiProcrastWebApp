<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class StatsAdminOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::query()->count())
            ->description('Registered Users')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
        Stat::make('Total Tasks', Task::query()->count())
            ->description('Numer of Tasks')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),
        Stat::make('Total Categories', Category::query()->count())
            ->description('Numer of Categories')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}
