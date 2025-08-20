<?php

namespace App\Filament\Widgets;

use App\Models\Dataset;
use Filament\Widgets\ChartWidget;

class DatasetTrendsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $rows = Dataset::selectRaw('DATE(created_at) as tgl, COUNT(*) as jumlah')
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->get();

        return [
            'labels' => $rows->pluck('tgl')->toArray(),
            'datasets' => [
                [
                    'label' => 'Dataset Ditambahkan',
                    'data'  => $rows->pluck('jumlah')->toArray(),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => '#60a5fa',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
