<?php

namespace App\Filament\Widgets;

use App\Models\Topik;
use Filament\Widgets\ChartWidget;

class DatasetsByTopikChart extends ChartWidget
{
    protected static ?string $heading = 'Total Dataset per Topik';

    protected function getData(): array
    {
        $rows = Topik::withCount('datasets')->orderBy('topik')->get();
        $labels = $rows->pluck('topik')->toArray();
        $data = $rows->pluck('datasets_count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Dataset',
                    'data'  => $data,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
