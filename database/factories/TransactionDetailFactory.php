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
        // Get a random menu ID from existing menus
        $menuIds = \App\Models\Menu::pluck('id')->toArray();
        $randomMenuId = $this->faker->randomElement($menuIds);

        // Get the maximum quantity available for the selected menu
        $maxQuantity = \App\Models\Stock::where('menu_id', $randomMenuId)->value('quantity');

        // Generate random quantity within the available quantity range
        $quantity = $this->faker->numberBetween(1, $maxQuantity);

        // Get the menu's price
        $unitPrice = \App\Models\Menu::where('id', $randomMenuId)->value('price');

        // Calculate subtotal
        $subTotal = $unitPrice * $quantity;

        return [
            'menu_id' => $randomMenuId,
            'transaction_id' => function () {
                return \App\Models\Transaction::inRandomOrder()->first()->id;
            },
            'qty' => $quantity,
            'unitPrice' => $unitPrice,
            'subTotal' => $subTotal,
        ];
    }
}
