<?php

namespace App\Imports;

use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MenuTypeImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Type([
            'name' => $row[0],
            'icon' => $row[1],
            'category_id' => $row[2],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
