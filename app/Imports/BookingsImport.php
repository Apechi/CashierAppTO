<?php

namespace App\Imports;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class BookingsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Booking([
            'date' => $row[0],
            'table_id' => $row[1],
            'start_time' => $row[2],
            'end_time' => $row[3],
            'bookers_name' => $row[4],
            'total_customer' => $row[5],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
