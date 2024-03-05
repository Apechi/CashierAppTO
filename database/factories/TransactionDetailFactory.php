<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_id' => \App\Models\Menu::factory(),
            'transaction_id' => \App\Models\Transaction::factory(),
        ];
    }
}
