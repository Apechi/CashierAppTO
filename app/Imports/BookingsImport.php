<?php

namespace App\Imports;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookingsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Booking([
            'date' => $row['tanggal'],
            'table_id' => $row['nomor_meja'],
            'start_time' => $row['waktu_mulai'],
            'end_time' => $row['waktu_selesai'],
            'bookers_name' => $row['nama_pemesan'],
            'total_customer' => $row['total_pelanggan'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
