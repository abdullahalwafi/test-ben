<?php

namespace App\Filament\Widgets;

use App\Models\Dataset;
use App\Models\Topik;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalDataset = \App\Models\Dataset::count();
        $totalTopik   = \App\Models\Topik::count();
        $lastUpdate   = optional(\App\Models\Dataset::max('updated_at'))->diffForHumans() ?? '-';

        $latest = \App\Models\Dataset::latest()->first();

        return [
            Stat::make('Total Dataset', (string)$totalDataset)
                ->description("Total semua dataset")
                ->color('success'),

            Stat::make('Total Topik', (string)$totalTopik)
                ->description('Jumlah kategori/topik unik')
                ->color('info'),

            Stat::make('Update Terakhir', $lastUpdate)
                ->description($latest?->nama_dataset ?? 'Belum ada dataset')
                ->color('warning'),

            Stat::make('Dataset Terbaru', $latest?->nama_dataset ?? '-')
                ->description($latest?->created_at->diffForHumans() ?? '-')
                ->color('primary'),

            Stat::make(
                'Topik Paling Banyak Dataset',
                \App\Models\Topik::withCount('datasets')->orderByDesc('datasets_count')->first()?->topik ?? '-'
            )->description('Topik dengan dataset terbanyak')
                ->color('danger'),
        ];
    }
}
