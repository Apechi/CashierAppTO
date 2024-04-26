<?php

namespace App\Imports;

use App\Models\Menu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Menu([
            'name' => $row['nama_menu'],
            'price' => $row['harga'],
            'image' => $row['image'],
            'description' => $row['deskripsi'],
            'type_id' => $row['id_tipe'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
