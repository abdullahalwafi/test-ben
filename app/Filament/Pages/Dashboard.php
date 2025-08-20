<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\DatasetsByTopikChart;
use App\Filament\Widgets\DatasetTrendsChart;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            DatasetsByTopikChart::class,
            DatasetTrendsChart::class,
        ];
    }
}
