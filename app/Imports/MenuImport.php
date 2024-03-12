<?php

namespace App\Imports;

use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MenuImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Menu([
            'name' => $row[0],
            'price' => $row[1],
            'image' => $row[2],
            'description' => $row[3],
            'type_id' => $row[4],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
