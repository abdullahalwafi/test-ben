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
        $total = Dataset::count();
        $byTopik = Topik::withCount('datasets')->orderByDesc('datasets_count')->get();

        $top3 = $byTopik->take(3)->map(fn($t) => "{$t->topik}: {$t->datasets_count}")->implode(' | ');
        return [
            Stat::make('Total Dataset', (string)$total)
                ->description($top3 ?: 'Belum ada data'),
            Stat::make('Total Topik', (string)Topik::count())
                ->description('Distinct kategori/topik'),
            Stat::make('Update Terakhir', optional(Dataset::max('updated_at'))->diffForHumans() ?? '-'),
        ];
    }
}
