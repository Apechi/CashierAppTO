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

        $timestamp = now()->format('YmdHis');

        $lastCustomId = Transaction::where('id', 'like', $timestamp . '%')->orderByDesc('id')->first();

        if ($lastCustomId) {

            $lastIdNumeric = intval(substr($lastCustomId->id, -4));
            $newIdNumeric = $lastIdNumeric + 1;
        } else {

            $newIdNumeric = 1;
        }

        $newId = $timestamp . str_pad($newIdNumeric, 4, '0', STR_PAD_LEFT);

        return $newId;
    }


    private function createTransactionDetails(Transaction $transaction)
    {
        
        $menus = \App\Models\Menu::all();

        
        $numberOfDetails = rand(1, 5);

        for ($i = 0; $i < $numberOfDetails; $i++) {
            $menu = $menus->random(); 

            TransactionDetail::create([
                'menu_id' => $menu->id,
                'transaction_id' => $transaction->id,
                'qty' => rand(1, 5), 
                'unitPrice' => $menu->price, 
                'subTotal' => $menu->price * rand(1, 5), 
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
