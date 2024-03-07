<?php

namespace App\Imports;

use App\Models\ProdukTitipan;
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
        
    }
}
