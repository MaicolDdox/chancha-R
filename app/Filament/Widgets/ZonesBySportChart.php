<?php

namespace App\Filament\Widgets;

use App\Models\Sport;
use Filament\Widgets\ChartWidget;

class ZonesBySportChart extends ChartWidget
{
    protected ?string $heading = 'Zonas por deporte';

    protected int|string|array $columnSpan = 6;

    protected function getData(): array
    {
        $sports = Sport::query()
            ->withCount('zones')
            ->orderBy('name')
            ->get(['id', 'name']);

        return [
            'datasets' => [
                [
                    'label' => 'Zonas',
                    'data' => $sports->pluck('zones_count')->map(static fn (int $count): int => $count)->all(),
                ],
            ],
            'labels' => $sports->pluck('name')->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
