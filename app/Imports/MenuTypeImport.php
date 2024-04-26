<?php

namespace App\Imports;

use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuTypeImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Type([
            'name' => $row['nama'],
            'icon' => $row['fontawesome_icon'],
            'category_id' => $row['id_kategori'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
