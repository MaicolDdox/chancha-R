<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sport;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->input('status', 'disponible');

        $zonesQuery = Zone::query()
            ->with(['sport', 'category']);

        if ($search = $request->string('search')->toString()) {
            $zonesQuery->where('name', 'like', '%'.$search.'%');
        }

        if ($request->filled('sport_id')) {
            $zonesQuery->where('sport_id', (int) $request->input('sport_id'));
        }

        if ($request->filled('category_id')) {
            $zonesQuery->where('category_id', (int) $request->input('category_id'));
        }

        if ($request->filled('location')) {
            $zonesQuery->where('location', $request->input('location'));
        }

        if ($request->filled('price_min')) {
            $zonesQuery->where('price_per_hour', '>=', (float) $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $zonesQuery->where('price_per_hour', '<=', (float) $request->input('price_max'));
        }

        if ($statusFilter !== 'all') {
            $zonesQuery->where('status', $statusFilter);
        }

        $availableAt = $request->input('available_at');
        $availableHours = (int) $request->input('available_hours', 1);

        if ($availableAt) {
            try {
                $startAt = Carbon::parse($availableAt);
                $endAt = (clone $startAt)->addHours(max(1, $availableHours));

                $zonesQuery->whereDoesntHave('reservations', function ($query) use ($startAt, $endAt) {
                    $query->whereIn('status', ['pendiente', 'confirmada'])
                        ->where(function ($query) use ($startAt, $endAt) {
                            $query->where('start_at', '<', $endAt)
                                ->where('end_at', '>', $startAt);
                        });
                });
            } catch (\Exception $exception) {
                // Ignore invalid date filter input.
            }
        }

        $zones = $zonesQuery
            ->orderBy('name')
            ->paginate(9, ['*'], 'zones_page')
            ->withQueryString();

        return view('dashboard', [
            'zones' => $zones,
            'sports' => Sport::query()->orderBy('name')->get(),
            'categories' => Category::query()->orderBy('name')->get(),
            'locations' => Zone::query()
                ->whereNotNull('location')
                ->where('location', '!=', '')
                ->select('location')
                ->distinct()
                ->orderBy('location')
                ->pluck('location'),
            'statusFilter' => $statusFilter,
        ]);
    }
}
