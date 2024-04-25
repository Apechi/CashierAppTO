<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiKaryawanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $absensi = new Absensi([
            'namaKaryawan' => $row['nama_karyawan'],
            'tanggalMasuk' => $row['tanggal_masuk'],
            'waktuMasuk' => $row['waktu_masuk'],
            'status' => $row['status'],
            'waktuKeluar' => $row['waktu_keluar'],
        ]);


        $absensi->save();
    }
}
