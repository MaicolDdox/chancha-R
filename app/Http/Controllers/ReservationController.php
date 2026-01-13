<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Invoice;
use App\Models\Reservation;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::query()
            ->with(['zone.category', 'zone.sport', 'invoice'])
            ->where('user_id', $request->user()->id)
            ->latest('start_at')
            ->paginate(8)
            ->withQueryString();

        return view('reservations.index', [
            'reservations' => $reservations,
        ]);
    }

    public function create(Request $request)
    {
        $zoneId = $request->query('zone');
        if (! $zoneId) {
            return redirect()
                ->route('dashboard')
                ->with('reservation_error', 'Selecciona una cancha para reservar.');
        }

        $zone = Zone::query()
            ->with(['sport', 'category'])
            ->findOrFail($zoneId);

        return view('reservations.create', [
            'zone' => $zone,
            'imageUrl' => $zone->image_url,
            'zoneData' => [
                'id' => $zone->id,
                'name' => $zone->name,
                'location' => $zone->location,
                'price_per_hour' => (float) $zone->price_per_hour,
                'sport' => $zone->sport?->name,
                'category' => $zone->category?->name,
            ],
            'taxRate' => (float) config('reservations.tax_rate', 0),
            'maxHours' => (int) config('reservations.max_hours', 8),
        ]);
    }

    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        $zone = Zone::query()->findOrFail($validated['zone_id']);
        if ($zone->status !== 'disponible') {
            throw ValidationException::withMessages([
                'zone_id' => 'La zona no esta disponible para reservar.',
            ]);
        }

        $startAt = Carbon::parse($validated['start_at']);
        $hours = (int) $validated['hours'];
        $endAt = (clone $startAt)->addHours($hours);

        if ($startAt->isPast()) {
            throw ValidationException::withMessages([
                'start_at' => 'La fecha debe ser en el futuro.',
            ]);
        }

        $overlap = Reservation::query()
            ->where('zone_id', $zone->id)
            ->whereIn('status', ['pendiente', 'confirmada'])
            ->where(function ($query) use ($startAt, $endAt) {
                $query->where('start_at', '<', $endAt)
                    ->where('end_at', '>', $startAt);
            })
            ->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'start_at' => 'La zona ya tiene una reserva en ese horario.',
            ]);
        }

        $taxRate = (float) config('reservations.tax_rate', 0);
        $hourlyPrice = (float) $zone->price_per_hour;
        $subtotal = $hourlyPrice * $hours;
        $taxes = round($subtotal * $taxRate, 2);
        $total = round($subtotal + $taxes, 2);

        $reservation = null;
        $invoice = null;

        DB::transaction(function () use (
            $validated,
            $user,
            $zone,
            $startAt,
            $endAt,
            $hours,
            $hourlyPrice,
            $subtotal,
            $taxes,
            $total,
            $taxRate,
            &$reservation,
            &$invoice
        ) {
            $reservation = Reservation::create([
                'zone_id' => $zone->id,
                'user_id' => $user->id,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'start_at' => $startAt,
                'hours' => $hours,
                'end_at' => $endAt,
                'hourly_price' => $hourlyPrice,
                'total' => $total,
                'status' => 'pendiente',
                'notes' => $validated['notes'] ?? null,
            ]);

            $invoice = Invoice::create([
                'reservation_id' => $reservation->id,
                'invoice_number' => $this->nextInvoiceNumber(),
                'subtotal' => $subtotal,
                'taxes' => $taxes,
                'total' => $total,
                'status' => 'pendiente',
                'payload' => [
                    'hours' => $hours,
                    'hourly_price' => $hourlyPrice,
                    'tax_rate' => $taxRate,
                ],
            ]);
        });

        return redirect()
            ->route('invoices.show', $invoice)
            ->with('reservation_success', 'Reserva creada. Completa el pago para confirmar.');
    }

    private function nextInvoiceNumber(): string
    {
        do {
            $candidate = 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
        } while (Invoice::query()->where('invoice_number', $candidate)->exists());

        return $candidate;
    }
}
