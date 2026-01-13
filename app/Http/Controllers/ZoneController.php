<?php

namespace App\Http\Controllers;

use App\Models\Zone;

class ZoneController extends Controller
{
    public function show(Zone $zone)
    {
        $zone->load(['category', 'sport']);

        return view('zones.show', [
            'zone' => $zone,
            'imageUrl' => $zone->image_url,
        ]);
    }
}
