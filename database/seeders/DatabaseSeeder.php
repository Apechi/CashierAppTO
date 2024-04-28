<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);

        \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'cashier@cashier.com',
                'password' => Hash::make('cashier'),
            ]);

        \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'booker@booker.com',
                'password' => Hash::make('booker'),
            ]);



        $this->call(PermissionsSeeder::class);

        $this->call(CategoryAndTypeSeed::class);
        $this->call(MenuSeeder::class);
        $this->call(StockSeeder::class);

        $this->call(CustomerSeeder::class);

        $this->call(TransactionSeeder::class);


        // \App\Models\Transaction::factory(250)->create()->each(function ($transaction) {
        //     $transaction->transactionDetails()->saveMany(\App\Models\TransactionDetail::factory(rand(1, 5))->make([
        //         'menu_id' => \App\Models\Menu::inRandomOrder()->first()->id,
        //     ]));
        // });

        // $this->call(BookingSeeder::class);

        // $this->call(TableSeeder::class);
        // $this->call(TransactionSeeder::class);
        // $this->call(TransactionDetailSeeder::class);

        // $this->call(UserSeeder::class);
    }
}
