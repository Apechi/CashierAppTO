<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Assuming you have 10 customers, we'll create transactions for each customer
        $customers = \App\Models\Customer::all();

        $totalTransactions = 1000; // Set the total number of transactions you want to create

        foreach ($customers as $customer) {
            $transactionsPerCustomer = $totalTransactions / $customers->count();

            for ($i = 0; $i < $transactionsPerCustomer; $i++) {
                $transaction = Transaction::create([
                    'id' => $this->generateCustomId(),
                    'date' => now()->subDays(rand(1, 30)), // Random date within the last 30 days
                    'total_price' => $this->getTotalPrice(), // Get actual total price
                    'payment_method' => ['cash', 'debit'][rand(0, 1)], // Random payment method
                    'keterangan' => 'Lorem ipsum dolor sit amet',
                    'customer_id' => $customer->id,
                ]);

                // Create transaction details for each transaction
                $this->createTransactionDetails($transaction);
            }
        }
    }

    private function generateCustomId()
    {
        // Generate a unique identifier based on the current timestamp
        $timestamp = now()->format('YmdHis');

        // Retrieve the last transaction ID created in the current timestamp format
        $lastCustomId = Transaction::where('id', 'like', $timestamp . '%')->orderByDesc('id')->first();

        if ($lastCustomId) {
            // Extract the numeric portion of the last ID and increment it
            $lastIdNumeric = intval(substr($lastCustomId->id, -4));
            $newIdNumeric = $lastIdNumeric + 1;
        } else {
            // If no transaction exists in the current timestamp, start from 1
            $newIdNumeric = 1;
        }

        // Generate the new custom ID by combining the timestamp and the incremented numeric portion
        $newId = $timestamp . str_pad($newIdNumeric, 4, '0', STR_PAD_LEFT);

        return $newId;
    }


    private function createTransactionDetails(Transaction $transaction)
    {
        // Assuming you have 10 different menus
        $menus = \App\Models\Menu::all();

        // You can adjust the number of transaction details per transaction
        $numberOfDetails = rand(1, 5);

        for ($i = 0; $i < $numberOfDetails; $i++) {
            $menu = $menus->random(); // Pick a random menu

            TransactionDetail::create([
                'menu_id' => $menu->id,
                'transaction_id' => $transaction->id,
                'qty' => rand(1, 5), // Random quantity
                'unitPrice' => $menu->price, // Get actual unit price from the menu
                'subTotal' => $menu->price * rand(1, 5), // Calculate sub total based on quantity
            ]);
        }
    }

    // Your generateCustomId method goes here

    private function getTotalPrice()
    {
        $existingTransactions = \App\Models\Transaction::all();

        if ($existingTransactions->isEmpty()) {
            // If there are no existing transactions, return a random total price
            return rand(20000, 500000); // Adjust the range as needed
        }

        $totalPriceSum = $existingTransactions->sum('total_price');
        $averageTotalPrice = $totalPriceSum / $existingTransactions->count();

        $variation = $averageTotalPrice * 0.10;
        $totalPrice = $averageTotalPrice + rand(-$variation, $variation);

        return max(0, $totalPrice);
    }
}
