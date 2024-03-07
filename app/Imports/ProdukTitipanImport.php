<?php

namespace App\Imports;

use App\Models\ProdukTitipan;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukTitipanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ProdukTitipan([
            'nama_produk' => $row[0],
            'nama_supplier' => $row[1],
            'harga_beli' => $row[2],
            'harga_jual' => $row[3],
            'stok' => $row[4],
            'keterangan' => $row[5],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
