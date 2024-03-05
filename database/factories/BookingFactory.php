<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'bookers_name' => $this->faker->text(255),
            'total_customer' => $this->faker->randomNumber(0),
            'table_id' => \App\Models\Table::factory(),
        ];
    }
}
