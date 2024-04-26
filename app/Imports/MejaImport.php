<?php

namespace App\Imports;

use App\Models\Table;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MejaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Table([
            'table_number' => $row['nomor_meja'],
            'capacity' => $row['kapasitas'],
            'status' => $row['status'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
