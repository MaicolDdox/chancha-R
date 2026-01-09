<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Carbon\CarbonImmutable;
use Filament\Widgets\ChartWidget;

class InvoicesByMonthChart extends ChartWidget
{
    protected ?string $heading = 'Ingresos por mes';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $endMonth = CarbonImmutable::now()->startOfMonth();
        $startMonth = $endMonth->subMonths(5);
        $rangeEnd = $endMonth->endOfMonth();

        $totalsByMonth = Invoice::query()
            ->whereBetween('created_at', [$startMonth, $rangeEnd])
            ->get(['total', 'created_at'])
            ->groupBy(static fn (Invoice $invoice): string => $invoice->created_at->format('Y-m'))
            ->map(static fn ($invoices): float => (float) $invoices->sum('total'));

        $labels = [];
        $data = [];

        for ($i = 0; $i < 6; $i++) {
            $month = $startMonth->addMonths($i);
            $key = $month->format('Y-m');

            $labels[] = $month->format('M Y');
            $data[] = $totalsByMonth->get($key, 0.0);
        }

        $palette = ['#2563eb', '#0ea5e9', '#22c55e', '#f59e0b', '#ef4444', '#8b5cf6'];
        $backgroundColors = [];

        for ($i = 0; $i < count($data); $i++) {
            $backgroundColors[] = $palette[$i % count($palette)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
