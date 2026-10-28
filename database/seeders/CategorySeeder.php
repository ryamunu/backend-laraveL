<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electrónica',  'description' => 'Productos electrónicos'],
            ['name' => 'Ropa',         'description' => 'Ropa para hombre y mujer'],
            ['name' => 'Hogar',        'description' => 'Productos para el hogar'],
            ['name' => 'Juguetes',     'description' => 'Juguetes para niños y niñas'],
            ['name' => 'Deportes',     'description' => 'Productos para deportes'],
            ['name' => 'Alimentos',    'description' => 'Alimentos para personas y animales'],
            ['name' => 'Belleza',      'description' => 'Productos de belleza'],
            ['name' => 'Salud',        'description' => 'Productos de salud'],
            ['name' => 'Moda',         'description' => 'Productos de moda'],
            ['name' => 'Tecnología',   'description' => 'Productos de tecnología'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
