<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = Menu::all();

        foreach ($menus as $menu) {

            $quantity = rand(5, 50);

            Stock::create([
                'quantity' => $quantity,
                'menu_id' => $menu->id,
            ]);
        }
    }
}
