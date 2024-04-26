<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row['nama'],
            'email' => $row['email'],
            'no_telp' => $row['no_telp'],
            'address' => $row['alamat'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
