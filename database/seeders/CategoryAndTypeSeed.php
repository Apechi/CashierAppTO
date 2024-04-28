<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryAndTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data kategori
        $categories = [
            ['icon' => 'fa fa-bowl-food', 'name' => 'Makanan'],
            ['icon' => 'fa fa-glass-martini', 'name' => 'Minuman'],
            ['icon' => 'fa fa-birthday-cake', 'name' => 'Kue'],
        ];

        foreach ($categories as $category) {
            $newCategory = Category::create([
                'icon' => $category['icon'],
                'name' => $category['name']
            ]);

            // Menambahkan data tipe untuk setiap kategori
            $types = $this->getTypesForCategory($newCategory->id);
            foreach ($types as $type) {
                Type::create([
                    'name' => $type['name'],
                    'icon' => $type['icon'],
                    'category_id' => $newCategory->id
                ]);
            }
        }
    }

    /**
     * Mendapatkan daftar tipe makanan berdasarkan ID kategori.
     */
    private function getTypesForCategory($categoryId): array
    {
        $types = [];

        switch ($categoryId) {
            case 1: // Makanan
                $types = [
                    ['name' => 'Vegetarian', 'icon' => 'fa fa-leaf'],
                    ['name' => 'Non-Vegetarian', 'icon' => 'fa fa-drumstick-bite'],
                ];
                break;
            case 2: // Minuman
                $types = [
                    ['name' => 'Kopi', 'icon' => 'fa fa-coffee'],
                    ['name' => 'Teh', 'icon' => 'fa fa-mug-hot'],
                    ['name' => 'Soda', 'icon' => 'fa fa-glass-whiskey'],
                    ['name' => 'Jus Buah', 'icon' => 'fa fa-apple-alt'],
                    ['name' => 'Es Krim', 'icon' => 'fa fa-ice-cream'],
                ];
                break;
            case 3: // Kue
                $types = [
                    ['name' => 'Brownies', 'icon' => 'fa fa-birthday-cake'],
                    ['name' => 'Donat', 'icon' => 'fa fa-birthday-cake'],
                    ['name' => 'Cupcake', 'icon' => 'fa fa-birthday-cake'],
                    ['name' => 'Roti', 'icon' => 'fa fa-bread-slice'],
                ];
                break;
        }

        return $types;
    }
}
