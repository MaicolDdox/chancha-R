<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sports = [
            [
                'name' => 'Futbol',
                'description' => 'Deporte de futbol.',
                'status' => 'activa',
            ],
            [
                'name' => 'Voleibol',
                'description' => 'Deporte de voleibol.',
                'status' => 'activa',
            ],
            [
                'name' => 'Basquetbol',
                'description' => 'Deporte de basquetbol.',
                'status' => 'activa',
            ],
            [
                'name' => 'Tenis',
                'description' => 'Deporte de tenis.',
                'status' => 'activa',
            ],
        ];

        foreach ($sports as $sport) {
            Sport::updateOrCreate(
                ['name' => $sport['name']],
                $sport,
            );
        }
    }
}
