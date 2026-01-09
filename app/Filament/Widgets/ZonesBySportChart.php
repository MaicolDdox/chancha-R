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

        $palette = ['#2563eb', '#0ea5e9', '#22c55e', '#f59e0b', '#ef4444', '#8b5cf6', '#14b8a6', '#f97316'];
        $backgroundColors = [];

        for ($i = 0; $i < $sports->count(); $i++) {
            $backgroundColors[] = $palette[$i % count($palette)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Zonas',
                    'data' => $sports->pluck('zones_count')->map(static fn (int $count): int => $count)->all(),
                    'backgroundColor' => $backgroundColors,
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
