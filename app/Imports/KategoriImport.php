<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class KategoriImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Category([
            'icon' => $row[0],
            'name' => $row[1],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
