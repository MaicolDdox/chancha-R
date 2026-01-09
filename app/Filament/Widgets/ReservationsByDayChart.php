<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Carbon\CarbonImmutable;
use Filament\Widgets\ChartWidget;

class ReservationsByDayChart extends ChartWidget
{
    protected ?string $heading = 'Reservas por dia';

    protected int|string|array $columnSpan = 6;

    protected function getData(): array
    {
        $endDay = CarbonImmutable::now()->endOfDay();
        $startDay = $endDay->subDays(13)->startOfDay();

        $countsByDay = Reservation::query()
            ->whereBetween('start_at', [$startDay, $endDay])
            ->get(['start_at'])
            ->groupBy(static fn (Reservation $reservation): string => $reservation->start_at->format('Y-m-d'))
            ->map(static fn ($reservations): int => $reservations->count());

        $labels = [];
        $data = [];

        for ($i = 0; $i < 14; $i++) {
            $day = $startDay->addDays($i);
            $key = $day->format('Y-m-d');

            $labels[] = $day->format('d M');
            $data[] = $countsByDay->get($key, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Reservas',
                    'data' => $data,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
