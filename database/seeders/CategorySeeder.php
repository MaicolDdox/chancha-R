<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cancha de futbol',
                'description' => 'Cancha para futbol.',
                'status' => 'activa',
            ],
            [
                'name' => 'Cancha de voleibol',
                'description' => 'Cancha para voleibol.',
                'status' => 'activa',
            ],
            [
                'name' => 'Cancha de basquetbol',
                'description' => 'Cancha para basquetbol.',
                'status' => 'activa',
            ],
            [
                'name' => 'Cancha de tenis',
                'description' => 'Cancha para tenis.',
                'status' => 'activa',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category,
            );
        }
    }
}
