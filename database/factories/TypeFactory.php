<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Type::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'icon' => $this->faker->text(255),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
