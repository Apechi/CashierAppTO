<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'total_price' => $this->faker->randomFloat(2, 0, 9999),
            'payment_method' => 'cash',
            'ketarangan' => $this->faker->sentence(15),
            'customer_id' => \App\Models\Customer::factory(),
        ];
    }
}
