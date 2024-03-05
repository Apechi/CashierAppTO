<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionDetail::factory()
            ->count(5)
            ->create();
    }
}
