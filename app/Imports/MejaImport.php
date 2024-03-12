<?php

namespace App\Imports;

use App\Models\Table;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MejaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Table([
            'table_number' => $row[0],
            'capacity' => $row[1],
            'status' => $row[2],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
