<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row[0],
            'email' => $row[1],
            'no_telp' => $row[2],
            'address' => $row[3],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

