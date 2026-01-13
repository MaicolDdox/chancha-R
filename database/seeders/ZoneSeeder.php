<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Sport;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            'Cancha de futbol',
            'Cancha de voleibol',
            'Cancha de basquetbol',
            'Cancha de tenis',
        ];

        $sportNames = [
            'Futbol',
            'Voleibol',
            'Basquetbol',
            'Tenis',
        ];

        $categories = Category::query()
            ->whereIn('name', $categoryNames)
            ->get()
            ->keyBy('name');

        $sports = Sport::query()
            ->whereIn('name', $sportNames)
            ->get()
            ->keyBy('name');

        $zones = [
            [
                'name' => 'Cancha Futbol 1',
                'category' => 'Cancha de futbol',
                'sport' => 'Futbol',
                'location' => 'Zona Norte',
                'description' => 'Cancha de futbol principal.',
                'price_per_hour' => 250.00,
                'status' => 'disponible',
            ],
            [
                'name' => 'Cancha Futbol 2',
                'category' => 'Cancha de futbol',
                'sport' => 'Futbol',
                'location' => 'Zona Centro',
                'description' => 'Cancha de futbol auxiliar.',
                'price_per_hour' => 230.00,
                'status' => 'disponible',
            ],
            [
                'name' => 'Cancha Voleibol 1',
                'category' => 'Cancha de voleibol',
                'sport' => 'Voleibol',
                'location' => 'Zona Sur',
                'description' => 'Cancha de voleibol techada.',
                'price_per_hour' => 180.00,
                'status' => 'disponible',
            ],
            [
                'name' => 'Cancha Basquetbol 1',
                'category' => 'Cancha de basquetbol',
                'sport' => 'Basquetbol',
                'location' => 'Zona Oriente',
                'description' => 'Cancha de basquetbol exterior.',
                'price_per_hour' => 200.00,
                'status' => 'disponible',
            ],
            [
                'name' => 'Cancha Tenis 1',
                'category' => 'Cancha de tenis',
                'sport' => 'Tenis',
                'location' => 'Zona Occidente',
                'description' => 'Cancha de tenis rapida.',
                'price_per_hour' => 220.00,
                'status' => 'disponible',
            ],
        ];

        foreach ($zones as $zone) {
            $category = $categories->get($zone['category']);
            $sport = $sports->get($zone['sport']);

            if (! $category || ! $sport) {
                continue;
            }

            Zone::updateOrCreate(
                [
                    'name' => $zone['name'],
                    'category_id' => $category->id,
                    'sport_id' => $sport->id,
                ],
                [
                    'description' => $zone['description'],
                    'location' => $zone['location'],
                    'price_per_hour' => $zone['price_per_hour'],
                    'status' => $zone['status'],
                    'image' => null,
                ],
            );
        }
    }
}
