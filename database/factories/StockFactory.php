<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),
            'menu_id' => \App\Models\Menu::factory(),
        ];
    }
}
