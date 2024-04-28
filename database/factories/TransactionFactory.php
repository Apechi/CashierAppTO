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
        // Get a random customer ID from existing customers
        $customerIds = \App\Models\Customer::pluck('id')->toArray();
        $randomCustomerId = $this->faker->randomElement($customerIds);

        // Generate a random date within the year 2023
        // Generate a random date within the year 2023
        $randomDate = $this->faker->dateTimeBetween('2023-01-01', '2023-12-31')->format('Ymd');

        // Generate a custom transaction ID
        $customId = $this->generateCustomId($randomDate);

        // Generate a random number of items in the transaction (between 1 and 10)
        $numberOfItems = $this->faker->numberBetween(1, 10);

        // Generate random prices for each item and calculate the total price
        $totalPrice = 0;
        for ($i = 0; $i < $numberOfItems; $i++) {
            $pricePerItem = $this->faker->randomFloat(2, 1, 100); // Random price per item between 1 and 100
            $quantity = $this->faker->numberBetween(1, 5); // Random quantity of each item between 1 and 5
            $totalPrice += $pricePerItem * $quantity;
        }

        return [
            'id' => $customId,
            'date' => $randomDate,
            'total_price' => $totalPrice,
            'payment_method' => $this->faker->randomElement(['cash', 'debit']),
            'keterangan' => $this->faker->sentence(15),
            'customer_id' => $randomCustomerId,
        ];
    }

    /**
     * Generate custom transaction ID based on a specific date.
     *
     * @param string $date The date for which to generate the custom ID (format: 'Ymd').
     * @return string
     */
    private function generateCustomId(string $date): string
    {
        // Retrieve the last custom ID for the given date
        $lastCustomId = \App\Models\Transaction::where('id', 'LIKE', $date . '%')->orderBy('id', 'desc')->first();

        if ($lastCustomId) {
            // Extract the counter part of the last ID
            $lastCounter = intval(substr($lastCustomId->id, -4));

            // Generate a random counter value that avoids collisions with existing IDs
            $randomCounter = $this->generateRandomCounter($date, $lastCounter);

            // Construct the new ID
            $newId = $date . str_pad($randomCounter, 4, '0', STR_PAD_LEFT);
        } else {
            // No previous ID exists for this date, start with 0001
            $newId = $date . '0001';
        }

        return $newId;
    }

    /**
     * Generate a random counter value that avoids collisions with existing IDs for the given date.
     *
     * @param string $date The date part of the ID.
     * @param int $lastCounter The counter value from the last ID.
     * @return int
     */
    private function generateRandomCounter(string $date, int $lastCounter): int
    {
        // Retrieve existing counter values for the given date
        $existingCounters = \App\Models\Transaction::where('id', 'LIKE', $date . '%')->pluck('id')->map(function ($id) {
            return intval(substr($id, -4));
        })->toArray();

        // Generate a random counter value (0001 to 9999)
        // Ensure it doesn't conflict with existing counters or the last counter
        do {
            $randomCounter = $this->faker->numberBetween(1, 9999);
        } while (in_array($randomCounter, $existingCounters) || $randomCounter === $lastCounter);

        return $randomCounter;
    }
}
