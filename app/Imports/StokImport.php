<?php

namespace App\Imports;

use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class StokImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Stock([
            'quantity' => $row[0],
            'menu_id' => $row[1],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
